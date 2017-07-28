<?php
namespace Drupal\intergrupo\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

define("intergrupo", "intergrupo");
define("entity",   "entity");

/**
 * Form handler for the Example add and edit forms.
 */
class IntergrupoForm extends EntityForm {

  /**
   * Constructs an ExampleForm object.
   *
   * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query
   *   The entity query.
   */
  public function __construct(QueryFactory $entity_query) {
    $this->entityQuery = $entity_query;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $obj = $this->entity;

    $form['delete'] = array(
      '#type' => 'checkbox', 
      '#title' => t('Delete'),
      '#access' => FALSE,
    );

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('name'),
      '#maxlength' => 50,
      '#size' => 50,
      '#default_value' => $obj->label(),
      '#description' => $this->t("nombre de la persona"),
      '#required' => TRUE,
    );

    $form['document'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('document'),
      '#maxlength' => 20,
      '#size' => 20,
      '#default_value' => $this->entity->document,
      '#machine_name' => array(
        'exists' => array($this, 'exist'),
      ),
      '#disabled' => !$obj->isNew(),
      '#description' => $this->t("Documento de la persona"),
      '#required' => TRUE,
    );

   $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('email'),
      '#maxlength' => 40,
       '#size' => 40,
      '#default_value' => $this->entity->email,
      '#description' => $this->t("Email de la persona"),
      '#required' => TRUE,
    );

    $form['date'] = array(
      '#type' => 'date',
      '#title' => $this->t('Date'),
      '#maxlength' => 19,
      '#default_value' => $this->entity->date,
      '#description' => $this->t("Fecha de la cita"),
      '#required' => TRUE,
    );

    $form['hour'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('hour'),
      '#maxlength' => 25,
      '#size' => 10,
      '#default_value' => $this->entity->hour,
      '#description' => $this->t("Hora de la cita"),
      '#required' => TRUE,
    );

    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('description'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->description,
      '#description' => $this->t("Description de la cita"),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $obj->id(),
      '#machine_name' => array(
        'exists' => array($this, 'exist'),
      ),
      '#disabled' => !$obj->isNew(),
    );

    // You will need additional form elements for your custom properties.
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $db = \Drupal::database();
    $result = $db->insert('intergrupo') // Table name no longer needs {}
        ->fields(array(
           'fid' => '3',
            'module' => intergrupo,
            'type' => entity,
            'document' => $this->entity->document,
            'email' => $this->entity->email,
            'date' => $this->entity->date,
            'hour' => $this->entity->hour,
            'description' => $this->entity->description,
        ))
        ->execute(); 
     // Entity Save.     
     $example = $this->entity;
     $status = $example->save();

     if ($status) {
        drupal_set_message($this->t('Guardado la %label Intergrupo.', array(
          '%label' => $example->label(),
        )));
      }
      else {
        drupal_set_message($this->t('El %label no pudo ser guardado.', array(
          '%label' => $example->label(),
        )));
      }

     $form_state->setRedirect('entity.intergrupo.collection');
  }

  /**
   * Helper function to check whether an Example configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityQuery->get('intergrupo')
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }

}