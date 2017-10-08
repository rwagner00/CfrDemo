<?php

namespace Drupal\cfr\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class CfrDemoController.
 */
class CfrDemoController extends ControllerBase {

  protected $json_url = "https://feeds.citibikenyc.com/stations/stations.json";

  protected $data;


  /**
   * CfrDemoController constructor.
   *
   * Immediately load and process the JSON data into a usable format.
   */
  public function __construct() {
    $data = file_get_contents($this->json_url);
    $data = json_decode($data);

    // Ensure that we retrieved useful data.
    if (!isset($data->stationBeanList) || !is_array($data->stationBeanList)) {
      $this->data = FALSE;
    }
    else {
      $this->data = $data;
    }
  }

  /**
   * All Filter
   *
   * @return mixed
   */
  public function allFilter() {

    // There's really a hundred ways to do this, but for a small
    // number of filters with a large number of items, the simplest
    // method is likely the most performant. Filters are grouped by
    // type to avoid having a giant 'if' statement and make it more
    // readable/maintainable. Other solutions are generally more
    // memory intensive, more CPU intensive, or needlessly complicated
    // for the number of filters we're working with.

    // Check to be sure that useful data was obtained..
    if ($this->data == FALSE) {
      return [
        '#type' => 'markup',
        '#markup' => $this->t('An error has occurred while attempting to retrieve data. Please try again later. If error persists, please contact webmaster.'),
      ];
    }

    $items = $this->data->stationBeanList;

    foreach ($items as $key => $item) {
      // Positive filters first.
      if ($item->id != 522 || $item->stationName != 'Forsyth St & Broome St') {
        unset($items[$key]);
      }
      // Greater/Less than filters.
      elseif ($item->availableBikes < 10) {
        unset($items[$key]);
      }
      // Negative filters.
      elseif (substr($item->lastCommunicationTime, 0, 10) == '1969-12-31') {
        unset($items[$key]);
      }
    }

    return [
      '#theme' => 'cfr_station_list_alternate',
      '#items' => $items,
    ];

  }

  /**
   * Or Filter
   *
   * @return array
   */
  public function orFilter() {
    $filtered = [];

    // As noted in the allFilter, there's a bunch of ways to do this, but
    // for the number of filters present, there's really no need in adding
    // overhead by overcomplicating this.
    if ($this->data == FALSE) {
      return [
        '#type' => 'markup',
        '#markup' => $this->t('An error has occurred while attempting to retrieve data. Please try again later. If error persists, please contact webmaster.'),
      ];
    }

    $items = $this->data->stationBeanList;

    foreach ($items as $key => $item) {
      if (($item->id == 522 || $item->stationName == 'Forsyth St & Broome St' || $item->availableBikes >= 10) && substr($item->lastCommunicationTime, 0, 10) != '1969-12-31') {
        $filtered[] = $item;
      }
    }

    return [
      '#theme' => 'cfr_station_list',
      '#items' => $filtered,
    ];

  }
}
