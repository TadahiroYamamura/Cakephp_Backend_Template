<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Faq Entity
 *
 * @property int $id
 * @property int|null $faq_category_id
 * @property string|null $question
 * @property string|null $answer
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\FaqCategory $faq_category
 */
class Faq extends Entity
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
        'faq_category_id' => true,
        'question' => true,
        'answer' => true,
        'modified' => true,
        'created' => true,
        'faq_category' => true
    ];
}
