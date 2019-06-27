<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SkillCategories Model
 *
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\HasMany $Skills
 *
 * @method \App\Model\Entity\SkillCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\SkillCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SkillCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SkillCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SkillCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SkillCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SkillCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SkillCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class SkillCategoriesTable extends Table
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

        $this->setTable('skill_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Skills', [
            'foreignKey' => 'skill_category_id'
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
