<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * JobDetail Entity
 *
 * @property int $job_id
 * @property string $name
 * @property string|null $value
 *
 * @property \App\Model\Entity\Job $job
 */
class JobDetail extends Entity
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
        'name' => true,
        'value' => true,
        'job' => true
    ];
}
