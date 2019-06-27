<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property int $id
 * @property string $item_no
 * @property int|null $display_flg
 * @property \Cake\I18n\FrozenTime|null $start_date
 * @property \Cake\I18n\FrozenTime|null $expire_date
 * @property string|null $hiring_company
 * @property string|null $job_title
 * @property int $job_category_id
 * @property string|null $job_type
 * @property string|null $job_description
 * @property string|null $requirement
 * @property int|null $prefecture
 * @property string|null $address
 * @property string|null $street
 * @property string|null $period_from
 * @property string|null $period_to
 * @property int $salary_minimum
 * @property int $salary_maximum
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\JobCategory $job_category
 * @property \App\Model\Entity\Apply[] $applies
 * @property \App\Model\Entity\Favorite[] $favorites
 * @property \App\Model\Entity\JobDetail[] $job_details
 * @property \App\Model\Entity\Skill[] $skills
 */
class Job extends Entity
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
        'item_no' => true,
        'display_flg' => true,
        'start_date' => true,
        'expire_date' => true,
        'hiring_company' => true,
        'job_title' => true,
        'job_category_id' => true,
        'job_type' => true,
        'job_description' => true,
        'requirement' => true,
        'prefecture' => true,
        'address' => true,
        'street' => true,
        'period_from' => true,
        'period_to' => true,
        'salary_minimum' => true,
        'salary_maximum' => true,
        'modified' => false,
        'created' => false,
        'job_category' => true,
        'applies' => true,
        'favorites' => true,
        'job_details' => true,
        'skills' => true
    ];
}
