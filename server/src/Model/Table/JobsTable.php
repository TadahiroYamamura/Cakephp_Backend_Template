<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Jobs Model
 *
 * @property \App\Model\Table\JobCategoriesTable|\Cake\ORM\Association\BelongsTo $JobCategories
 * @property \App\Model\Table\AppliesTable|\Cake\ORM\Association\HasMany $Applies
 * @property \App\Model\Table\FavoritesTable|\Cake\ORM\Association\HasMany $Favorites
 * @property \App\Model\Table\JobDetailsTable|\Cake\ORM\Association\HasMany $JobDetails
 * @property \App\Model\Table\SkillsTable|\Cake\ORM\Association\BelongsToMany $Skills
 *
 * @method \App\Model\Entity\Job get($primaryKey, $options = [])
 * @method \App\Model\Entity\Job newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Job[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Job|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Job saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Job patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Job[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Job findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobsTable extends Table
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

        $this->setTable('jobs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AreaNames', [
            'foreignKey' => 'prefecture',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('JobCategories', [
            'foreignKey' => 'job_category_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Applies', [
            'foreignKey' => 'job_id'
        ]);
        $this->hasMany('Favorites', [
            'foreignKey' => 'job_id'
        ]);
        $this->hasMany('JobDetails', [
            'foreignKey' => 'job_id'
        ]);
        $this->belongsToMany('Skills', [
            'foreignKey' => 'job_id',
            'targetForeignKey' => 'skill_id',
            'joinTable' => 'jobs_skills'
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
            ->scalar('item_no')
            ->maxLength('item_no', 50)
            ->requirePresence('item_no', 'create')
            ->notEmptyString('item_no')
            ->add('item_no', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('display_flg')
            ->allowEmptyString('display_flg');

        $validator
            ->dateTime('start_date')
            ->allowEmptyDateTime('start_date');

        $validator
            ->dateTime('expire_date')
            ->allowEmptyDateTime('expire_date');

        $validator
            ->scalar('hiring_company')
            ->maxLength('hiring_company', 127)
            ->allowEmptyString('hiring_company');

        $validator
            ->scalar('job_title')
            ->maxLength('job_title', 255)
            ->allowEmptyString('job_title');

        $validator
            ->scalar('job_type')
            ->maxLength('job_type', 255)
            ->allowEmptyString('job_type');

        $validator
            ->scalar('job_description')
            ->allowEmptyString('job_description');

        $validator
            ->scalar('requirement')
            ->allowEmptyString('requirement');

        $validator
            ->nonNegativeInteger('prefecture')
            ->allowEmptyString('prefecture');

        $validator
            ->scalar('address')
            ->maxLength('address', 63)
            ->allowEmptyString('address');

        $validator
            ->scalar('street')
            ->maxLength('street', 127)
            ->allowEmptyString('street');

        $validator
            ->scalar('period_from')
            ->maxLength('period_from', 255)
            ->allowEmptyString('period_from');

        $validator
            ->scalar('period_to')
            ->maxLength('period_to', 255)
            ->allowEmptyString('period_to');

        $validator
            ->integer('salary_minimum')
            ->requirePresence('salary_minimum', 'create')
            ->notEmptyString('salary_minimum');

        $validator
            ->integer('salary_maximum')
            ->requirePresence('salary_maximum', 'create')
            ->notEmptyString('salary_maximum');

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
        $rules->add($rules->isUnique(['item_no']));
        $rules->add($rules->existsIn(['job_category_id'], 'JobCategories'));

        return $rules;
    }

    public function queryJobs($args, $user) {
        $query = $this->find();

        // join tables
        $tables = [];
        $tables[] = "JobCategories";
        $tables[] = "AreaNames";
        $tables[] = "Skills";
        if (!is_null($user)) $tables[] = [
            "Favorites" => [
                "fields" => ["job_id"],
                "conditions" => ["user_id" => $user["id"]],
            ]
        ];
        $query->contain($tables);

        $query->where([
            "display_flg" => 1,
            "NOW() between start_date and expire_date",
        ]);

        if (isset($args["skill"])) {
            // query SkillCategories
            $categories = [];
            foreach (TableRegistry::getTableLocator()->get("SkillCategories")->find() as $c) {
                $this->filterBySkill($query, $args["skill"], $c["id"], $c["key"]);
            }
        }

        if (isset($args["area"])) {
            $query->where([
                "prefecture" => $args["area"],
            ]);
        }

        if (isset($args["salary"])) {
            $query->where([
                "salary_minimum >= " => $args["salary"],
            ]);
        }

        if (isset($args["word"])) {
            $cols = ["hiring_company", "job_title", "job_type", "job_description", "requirement", "address", "street"];
            foreach ($args["word"] as $word) {
                $query->where([
                    "OR" => array_map(function($c) use($word) { return ["$c like" => "%$word%"]; }, $cols),
                ]);
            }
        }

        // remove duplication by ID
        $tmp = [];
        $buf = [];
        foreach ($query as $res) {
            $id = $res["id"];
            if (in_array($id, $tmp)) continue;
            $tmp[] = $id;
            $buf[] = $res;
        }
        return $buf;
    }

    private function filterBySkill($query, $options, $category_id, $key) {
        return $query->matching("Skills", function($q) use($options, $category_id, $key) {
            if (isset($options[$key])) {
                return $q->where([
                    "Skills.skill_category_id" => $category_id,
                    "Skills.name in" => $options[$key],
                ]);
            }
            return $q;
        });
    }
}
