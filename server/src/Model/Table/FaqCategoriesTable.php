<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FaqCategories Model
 *
 * @property \App\Model\Table\FaqsTable|\Cake\ORM\Association\HasMany $Faqs
 *
 * @method \App\Model\Entity\FaqCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\FaqCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FaqCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FaqCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FaqCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FaqCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FaqCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FaqCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class FaqCategoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('faq_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Faqs', [
            'foreignKey' => 'faq_category_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        return $validator;
    }
}
