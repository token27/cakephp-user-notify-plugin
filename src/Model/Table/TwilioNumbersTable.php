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
 * TwilioNumbers Model
 *
 * @method \App\Model\Entity\TwilioNumber newEmptyEntity()
 * @method \App\Model\Entity\TwilioNumber newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TwilioNumber[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TwilioNumber get($primaryKey, $options = [])
 * @method \App\Model\Entity\TwilioNumber findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TwilioNumber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TwilioNumber[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TwilioNumber|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TwilioNumber saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TwilioNumber[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TwilioNumber[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TwilioNumber[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TwilioNumber[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TwilioNumbersTable extends UserNotifyTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('twilio_numbers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
                ->scalar('name')
                ->maxLength('name', 50)
                ->requirePresence('name', 'create')
                ->notEmptyString('name');

        $validator
                ->scalar('prefix')
                ->maxLength('prefix', 5)
                ->requirePresence('prefix', 'create')
                ->notEmptyString('prefix');

        $validator
                ->scalar('identifier')
                ->maxLength('identifier', 50)
                ->allowEmptyString('identifier');

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

}
