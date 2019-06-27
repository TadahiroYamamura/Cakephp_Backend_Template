<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Profile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $sei
 * @property string|null $mei
 * @property int|null $gender
 * @property \Cake\I18n\FrozenDate|null $birthday
 * @property string|null $zipcode
 * @property int|null $prefecture
 * @property string|null $address
 * @property string|null $street
 * @property string|null $tel
 * @property string|null $email
 * @property string|null $photo
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ProfileDetail[] $profile_details
 */
class Profile extends Entity
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
        'sei' => true,
        'mei' => true,
        'gender' => true,
        'birthday' => true,
        'zipcode' => true,
        'prefecture' => true,
        'address' => true,
        'street' => true,
        'tel' => true,
        'email' => true,
        'photo' => true,
        'modified' => true,
        'created' => true,
        'user' => true,
        'profile_details' => true
    ];
}
