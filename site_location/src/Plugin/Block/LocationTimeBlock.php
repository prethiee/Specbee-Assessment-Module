<?php

namespace Drupal\site_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\site_location\CurrentTimeService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "site_location_example",
 *   admin_label = @Translation("LocationTimeBlock"),
 *   category = @Translation("Site Location and Time")
 * )
 */
class LocationTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructor for the block plugin.
   *
   * @param array $configuration
   *   The configuration to use.
   * @param string $plugin_id
   *   The plugin id.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param Drupal\site_location\CurrentTimeService $current_time
   *   The current time service data.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CurrentTimeService $current_time) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->current_time = $current_time;
  }

  /**
   * Gets typed data for a given configuration name and its values.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container interface.
   * @param array $configuration
   *   The configuration to use.
   * @param string $plugin_id
   *   The plugin id.
   * @param mixed $plugin_definition
   *   The plugin definition.
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('site_location.current_time')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->current_time->getData(),
      '#cache' => [
        'tags' => ['config:site_location.settings'],
      ],
    ];
    return $build;
  }

}
