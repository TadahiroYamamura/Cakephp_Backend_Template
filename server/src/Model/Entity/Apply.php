<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Apply Entity
 *
 * @property int $id
 * @property int $job_id
 * @property int $user_id
 * @property string|null $email
 * @property string|null $tel
 * @property string|null $sei
 * @property string|null $mei
 * @property string|null $sei_kana
 * @property string|null $mei_kana
 * @property \Cake\I18n\FrozenDate|null $birthday
 * @property int $gender
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\Job $job
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ApplyDetail[] $apply_details
 */
class Apply extends Entity
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
        'job_id' => true,
        'user_id' => true,
        'email' => true,
        'tel' => true,
        'sei' => true,
        'mei' => true,
        'sei_kana' => true,
        'mei_kana' => true,
        'birthday' => true,
        'gender' => true,
        'modified' => true,
        'created' => true,
        'job' => true,
        'user' => true,
        'apply_details' => true
    ];
}
