<?php

namespace Drupal\bass_guitar_brands\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
 * Provides the form for adding countries.
 */
class BassGuitarBrandClassForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bass_guitar_brands_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {


    // Textfield.
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Guitar Brand'),
      '#size' => 60,
      '#required' => TRUE,
      '#maxlength' => 128,
    ];

    // CheckBoxes.
    $form['bass_checkboxes'] = [
      '#type' => 'radios',
      '#options' => ['electric' => $this->t('Electic'), 'acoustic' => $this->t('Acoustic')],
      '#title' => $this->t('Prefer type of bass :'),
    ];

    // Color.
    $form['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Guitar Color'),
      '#default_value' => '#f0f0f0',
    ];

    // Date.
    $form['date'] = [
      '#type' => 'date',
      '#title' => $this->t('Date of Birth'),
      '#default_value' => ['year' => 2020, 'month' => 2, 'day' => 15],
    ];

    //Name
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your Name'),
      '#required' => TRUE,
      '#maxlength' => 25,
      '#default_value' => '',
    ];


    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#default_value' => $this->t('Save') ,
    ];
    
      $form['#theme'] = 'bass_guitar_brands_add_form';
      
    return $form;

  }

   /**
   * {@inheritdoc}
   */
  public function validateForm(array & $form, FormStateInterface $form_state) {

		
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    try{
      $conn = Database::getConnection();
      
      $fields= $form_state->getValues();
      $date =  new \DateTime( $fields['date']);
      
      $fields = [
        "title" =>$fields['title'],
        "bass_checkboxes" => $fields['bass_checkboxes'],
        "color" => $fields['color'],
        "date" =>$date->format('Y-m-d'),
        "name" => $fields['name'],
      ];

      $conn->insert('bass_guitars')
       ->fields($fields)->execute();
        \Drupal::messenger()->addMessage($this->t('The Bas Guitar Brand has been succesfully saved'));
       
    } catch(Exception $ex){
      \Drupal::logger('bass_guitars')->error($ex->getMessage());
    }
      
    } 

}
  
