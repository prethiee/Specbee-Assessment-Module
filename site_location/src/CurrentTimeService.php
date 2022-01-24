<?php

namespace Drupal\site_location;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class file for custom service.
 *
 * @package Drupal\site_location\Services
 */
class CurrentTimeService {

  /**
   * The admin toolbar tools configuration.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * The constructor to use.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('site_location.settings');
  }

  /**
   * The getData function.
   *
   * @return \Drupal\Component\Render\MarkupInterface|string
   *   The return string data.
   */
  public function getData() {
    $date = $this->getCurrentDateTime($this->config->get('timezone'));
    return $date;
  }

  /**
   * Function to fetch and format the date.
   */
  private function getCurrentDateTime($timezone) {
    $date = new DrupalDateTime("now", new \DateTimeZone($timezone));
    return $date->format('dS M Y - H:i A');
  }

}
