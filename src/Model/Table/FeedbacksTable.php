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
 * Feedbacks Model
 *
 * @property \App\Model\Table\NotificationsTable&\Cake\ORM\Association\BelongsTo $Notifications
 *
 * @method \App\Model\Entity\Feedback newEmptyEntity()
 * @method \App\Model\Entity\Feedback newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Feedback[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Feedback get($primaryKey, $options = [])
 * @method \App\Model\Entity\Feedback findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Feedback patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Feedback[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Feedback|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Feedback saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class FeedbacksTable extends UserNotifyTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('feedbacks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Notifications' => ['feedback_count'],
        ]);

        $this->belongsTo('Notifications', [
            'foreignKey' => 'notification_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn(['notification_id'], 'Notifications'), ['errorField' => 'notification_id']);

        return $rules;
    }

}
