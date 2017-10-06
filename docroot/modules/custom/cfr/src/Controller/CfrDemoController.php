<?php

namespace Drupal\cfr\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class CfrDemoController.
 */
class CfrDemoController extends ControllerBase
{

    /**
     * ID number 522
    2. Station name, “Forsyth St & Broome St”
    3. Omit entries from 1969-12-31
    4. When available bikes are greater than 10.
     */

    protected $json_url = "https://feeds.citibikenyc.com/stations/stations.json";


    // @todo update the description.

    /**
     * Main.
     *
     * @return array
     *   Return Hello string.
     */
    public function main()
    {

        $json_data = file_get_contents($this->json_url);

        if (!$json_data) {
            return [
                '#type' => 'markup',
                '#markup' => $this->t('An error has occurred while attempting to retrieve data. Please try again later. If error persists, please contact webmaster.')
            ];
        }

        $json_data = json_decode($json_data);
        $json_data = $json_data->stationBeanList;

        return [
            '#type' => 'markup',
            '#markup' => $this->t('Implement method: main')
        ];
    }

    protected function filter($items)
    {
        // There's really a hundred ways to do this, but for a small
        // number of filters with a large number of items, the simplest
        // method is likely the most performant. Filters are grouped by
        // type to avoid having a giant 'if' statement and make it more
        // readable/maintainable. Other solutions are generally more
        // memory intensive, more CPU intensive, or needlessly complicated
        // for the number of filters we're working with.
        foreach ($items as $key => $item) {
            // Positive filters first.
            if ($item->id != 522 || $item->stationName != 'Forsyth St & Broome St') {

            }
            // Greater/Less than filters.
            elseif ($item->availableBikes < 10) {

            }
            // Negative filters.
            elseif (substr($item->lastCommunicationTime, 0, 10) == '1969-12-31') {

            }
        }

    }
}
