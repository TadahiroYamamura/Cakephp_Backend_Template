<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $password
 * @property int|null $active
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\Apply[] $applies
 * @property \App\Model\Entity\Contact[] $contacts
 * @property \App\Model\Entity\Favorite[] $favorites
 * @property \App\Model\Entity\Profile[] $profiles
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'password' => true,
        'active' => true,
        'modified' => false,
        'created' => false,
        'applies' => true,
        'contacts' => true,
        'favorites' => true,
        'profiles' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($val) {
      if (strlen($val) > 0) {
        return (new DefaultPasswordHasher())->hash($val);
      }
    }
}
