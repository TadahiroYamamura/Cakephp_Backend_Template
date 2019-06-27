<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplyDetail Entity
 *
 * @property int|null $apply_id
 * @property string $name
 * @property string|null $value
 *
 * @property \App\Model\Entity\Apply $apply
 */
class ApplyDetail extends Entity
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
        'apply_id' => true,
        'name' => true,
        'value' => true,
        'apply' => true
    ];
}
