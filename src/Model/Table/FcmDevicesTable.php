<?php

declare(strict_types=1);

namespace UserNotify\Model\Table;

# CAKEPHP

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

# PLUGIN
use UserNotify\Model\Table\UserNotifyTable;

/**
 * FcmDevices Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\FcmDevice newEmptyEntity()
 * @method \App\Model\Entity\FcmDevice newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FcmDevice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FcmDevice get($primaryKey, $options = [])
 * @method \App\Model\Entity\FcmDevice findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FcmDevice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FcmDevice[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FcmDevice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FcmDevice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FcmDevice[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FcmDevice[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FcmDevice[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FcmDevice[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FcmDevicesTable extends UserNotifyTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('fcm_devices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {
        $validator
                ->uuid('id')
                ->allowEmptyString('id', null, 'create');

        $validator
                ->scalar('topic_place')
                ->maxLength('topic_place', 50)
                ->notEmptyString('topic_place');

        $validator
                ->scalar('topic_name')
                ->maxLength('topic_name', 50)
                ->notEmptyString('topic_name');

        $validator
                ->scalar('token')
                ->maxLength('token', 150)
                ->requirePresence('token', 'create')
                ->notEmptyString('token');

        $validator
                ->scalar('additional_data')
                ->allowEmptyString('additional_data');

        $validator
                ->dateTime('expire_at')
                ->allowEmptyDateTime('expire_at');

        $validator
                ->integer('status')
                ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->existsIn(['user_id'], 'UserAuth.Users'), ['errorField' => 'user_id']);

        return $rules;
    }

}
