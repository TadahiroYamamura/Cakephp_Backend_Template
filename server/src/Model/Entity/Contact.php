<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $contact_type
 * @property int|null $progress
 * @property string|null $name
 * @property string|null $email
 * @property string|null $tel
 * @property string|null $memo
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\User $user
 */
class Contact extends Entity
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
        'user_id' => true,
        'contact_type' => true,
        'progress' => true,
        'name' => true,
        'email' => true,
        'tel' => true,
        'memo' => true,
        'modified' => true,
        'created' => true,
        'user' => true
    ];
}
