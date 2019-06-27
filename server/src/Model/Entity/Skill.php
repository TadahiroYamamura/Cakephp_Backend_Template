<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Skill Entity
 *
 * @property int $id
 * @property string $name
 * @property int $skill_category_id
 *
 * @property \App\Model\Entity\SkillCategory $skill_category
 * @property \App\Model\Entity\Job[] $jobs
 */
class Skill extends Entity
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
        'skill_category_id' => true,
        'skill_category' => true,
        'jobs' => true
    ];
}
