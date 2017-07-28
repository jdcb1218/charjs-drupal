<?php 
namespace Drupal\intergrupo\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\intergrupo\IntergrupoInterface;

/**
 * Defines the intergrupo entity.
 *
 * @ConfigEntityType(
 *   id = "intergrupo",
 *   label = @Translation("intergrupo"),
 *   handlers = {
 *     "list_builder" = "Drupal\intergrupo\Controller\intergrupoListBuilder",
 *     "form" = {
 *       "add" = "Drupal\intergrupo\Form\intergrupoForm",
 *       "edit" = "Drupal\intergrupo\Form\intergrupoForm",
 *       "delete" = "Drupal\intergrupo\Form\intergrupoDeleteForm",
 *     }
 *   },
 *   config_prefix = "intergrupo",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/intergrupo/{intergrupo}",
 *     "delete-form" = "/admin/config/system/intergrupo/{intergrupo}/delete",
 *   }
 * )
 */
class Intergrupo extends ConfigEntityBase implements IntergrupoInterface {

  /**
   * The Example ID.
   * @var string
   */
  public $id;
  /**
   * The Example label.
   *
   * @var string
   */
  public $label;
 /**
   * The Example label.
   * @var string
   */
  public $delete;
 /**
   * The Example label.
   * @var string
   */ 
  public $document;
  /**
   * The Example label.
   * @var string
   */
  public $email;
  /**
   * The Example label.
   * @var string
   */

  public $date;
  /**
   * The Example label.
   * @var string
   */
   public $hour;
  /**
   * The Example label.
   * @var string
   */
   public $description;
  /**
   * The Example label.
   * @var string
   */
}