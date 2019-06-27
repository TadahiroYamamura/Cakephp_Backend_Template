<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AreaNames Model
 *
 * @method \App\Model\Entity\AreaName get($primaryKey, $options = [])
 * @method \App\Model\Entity\AreaName newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AreaName[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AreaName|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AreaName saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AreaName patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AreaName[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AreaName findOrCreate($search, callable $callback = null, $options = [])
 */
class AreaNamesTable extends Table
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

        $this->setTable('area_names');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('area_type')
            ->allowEmptyString('area_type');

        $validator
            ->scalar('area_name')
            ->maxLength('area_name', 255)
            ->allowEmptyString('area_name');

        return $validator;
    }
}
