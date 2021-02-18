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
 * Notifications Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FeedbacksTable&\Cake\ORM\Association\HasMany $Feedbacks
 * @property \App\Model\Table\SubjectsTable&\Cake\ORM\Association\HasMany $Subjects
 *
 * @method \App\Model\Entity\Notification newEmptyEntity()
 * @method \App\Model\Entity\Notification newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Notification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Notification get($primaryKey, $options = [])
 * @method \App\Model\Entity\Notification findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Notification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Notification[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Notification|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NotificationsTable extends UserNotifyTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('notifications');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->belongsTo('Users', [
//            'foreignKey' => 'user_id',
//            'joinType' => 'INNER',
//        ]);

        $this->hasMany('Feedbacks', [
            'foreignKey' => 'notification_id',
        ]);

        $this->hasMany('Subjects', [
            'foreignKey' => 'notification_id',
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
                ->scalar('type')
                ->maxLength('type', 20)
                ->requirePresence('type', 'create')
                ->notEmptyString('type');

        $validator
                ->scalar('title')
                ->maxLength('title', 150)
                ->requirePresence('title', 'create')
                ->notEmptyString('title');

        $validator
                ->scalar('body')
                ->allowEmptyString('body');

        $validator
                ->scalar('additional_data')
                ->allowEmptyString('additional_data');

        $validator
                ->integer('readed')
                ->notEmptyString('readed');

        $validator
                ->scalar('timezone')
                ->maxLength('timezone', 20)
                ->notEmptyString('timezone');

        $validator
                ->integer('sent')
                ->notEmptyString('sent');

        $validator
                ->dateTime('send_on')
                ->allowEmptyDateTime('send_on');

        $validator
                ->dateTime('sent_on')
                ->allowEmptyDateTime('sent_on');

        $validator
                ->integer('status')
                ->notEmptyString('status');

        $validator
                ->integer('subject_count')
                ->notEmptyString('subject_count');

        $validator
                ->integer('feedback_count')
                ->notEmptyString('feedback_count');

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
