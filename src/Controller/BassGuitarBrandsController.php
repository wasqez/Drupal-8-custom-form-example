<?php

namespace Drupal\bass_guitar_brands\Controller;
use Drupal\Core\Controller\ControllerBase;


/**
 * Class BassGuitarBrandsController.
 *
 * @package Drupal\bass_guitar_brands\Controller
 */
class BassGuitarBrandsController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function bassGuitarBrandslist() {
	
    $bassBrands = \Drupal::database()->select('bass_guitars', 'n')
            ->fields('n', ['title', 'bass_checkboxes', 'color', 'date', 'name'])
            ->execute()
            ->fetchAll();

    
    $response = [
      '#theme' => 'bass_guitar_brands', 
      '#brands' => $bassBrands,
      '#title' => $this->t('Our users make a list of Bass Guitar worldwide makers.'),
      '#slogan' => $this->t('We love bass. Bass is the groove.'),
    ];
    return $response;
 
	//print_r($response);die;
  }

}


