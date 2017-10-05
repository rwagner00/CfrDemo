<?php

namespace Drupal\cfr\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class CfrDemoController.
 */
class CfrDemoController extends ControllerBase {

  /**
   * Main.
   *
   * @return string
   *   Return Hello string.
   */
  public function main() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: main')
    ];
  }

}
