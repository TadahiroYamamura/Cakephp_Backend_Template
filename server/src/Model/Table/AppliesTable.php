<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applies Model
 *
 * @property \App\Model\Table\JobsTable|\Cake\ORM\Association\BelongsTo $Jobs
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ApplyDetailsTable|\Cake\ORM\Association\HasMany $ApplyDetails
 *
 * @method \App\Model\Entity\Apply get($primaryKey, $options = [])
 * @method \App\Model\Entity\Apply newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Apply[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Apply|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Apply saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Apply patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Apply[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Apply findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AppliesTable extends Table
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

        $this->setTable('applies');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Jobs', [
            'foreignKey' => 'job_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ApplyDetails', [
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 63)
            ->allowEmptyString('tel');

        $validator
            ->scalar('sei')
            ->maxLength('sei', 50)
            ->allowEmptyString('sei');

        $validator
            ->scalar('mei')
            ->maxLength('mei', 50)
            ->allowEmptyString('mei');

        $validator
            ->scalar('sei_kana')
            ->maxLength('sei_kana', 50)
            ->allowEmptyString('sei_kana');

        $validator
            ->scalar('mei_kana')
            ->maxLength('mei_kana', 50)
            ->allowEmptyString('mei_kana');

        $validator
            ->date('birthday')
            ->allowEmptyDate('birthday');

        $validator
            ->integer('gender')
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['job_id'], 'Jobs'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
