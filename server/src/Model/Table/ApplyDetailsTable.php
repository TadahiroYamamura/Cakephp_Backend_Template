<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplyDetails Model
 *
 * @property \App\Model\Table\AppliesTable|\Cake\ORM\Association\BelongsTo $Applies
 *
 * @method \App\Model\Entity\ApplyDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApplyDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApplyDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApplyDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplyDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplyDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApplyDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApplyDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplyDetailsTable extends Table
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

        $this->setTable('apply_details');
        $this->setDisplayField('name');

        $this->belongsTo('Applies', [
            'foreignKey' => 'apply_id'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('value')
            ->allowEmptyString('value');

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
        $rules->add($rules->existsIn(['apply_id'], 'Applies'));

        return $rules;
    }
}
