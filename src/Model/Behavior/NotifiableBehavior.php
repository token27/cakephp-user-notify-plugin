<?php

namespace UserNotify\Model\Behavior;

# CAKEPHP

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use ArrayObject;

# PLUGIN

/**
 * 
 */
class NotifiableBehavior extends Behavior {

    protected $_defaultConfig = [
        'subjects' => [],
    ];

    public function __construct(Table $table, array $config) {
        parent::__construct($table, $config);

//        if (!isset($config['subjects'][$table->getAlias()])) {
//            $config['subjects'][] = $table->getAlias();
//            $this->setConfig($config);
//
//            $table->hasMany('Notification', [
//                'className' => 'UserNotify.Notifications',
//                'foreignKey' => 'user_id'
//            ]);
//
//            $table->hasMany('Notification', [
//                'className' => 'UserNotify.Notifications',
//                'foreignKey' => 'user_id'
//            ]);
//        }
    }

    public function initialize(array $config): void {
        parent::initialize($config);
        echo "here";
        exit();
    }

    public function beforeFind(EventInterface $event, Query $query, ArrayObject $options, boolean $primary) {
        
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options) {
        
    }

    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options) {
        
    }

    public function beforeDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options) {
        
    }

    public function afterDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options) {
        
    }

    public function setup(Model $Model, $settings = array()) {
        echo "setup";
        exit();
        if (!isset($this->__settings[$Model->alias])) {
            $this->__settings[$Model->alias] = $this->default;
        }
        $this->__settings[$Model->alias] = array_merge($this->__settings[$Model->alias], is_array($settings) ? $settings : array());

        // bind the Like model to the current model
        $Model->bindModel(array(
            'hasMany' => array(
                'Notification' => array(
                    'className' => 'UserNotify.Notifications',
                    'foreignKey' => 'user_id',
                )
            )
                ), false);

        $belongsTo = array();
        foreach ($this->__settings[$Model->alias]['subjects'] as $subject) {
            $belongsTo[$subject] = array(
                'className' => $subject,
                'foreignKey' => 'model_id',
                'conditions' => array('Subject.model' => $subject)
            );
        }
        $Model->Notification->Subject->bindModel(compact('belongsTo'), false);
    }

    /**
     * 
     * Example : 
     * 
     * $this->User->notify(1, 'post_comment', array('User'=>2,'Comment'=>1));
     * 
     * $this->User->id = 1;
     * $this->User->notify('post_comment', array('User'=>2,'Comment'=>1));
     * 
     */
    public function notify(Model $Model, $user_id, $type, $subjects = array()) {

        if (is_string($user_id) && is_array($type)) {
            $subjects = $type;
            $type = $user_id;
            $user_id = $Model->id;
        }

        if (empty($user_id))
            return false;

        $notification = array(
            'Notification' => array(
                'user_id' => $user_id,
                'type' => $type,
            ),
            'Subject' => array()
        );

        foreach ($subjects as $model => $model_id) {
            $notification['Subject'][] = compact('model', 'model_id');
        }

        $Model->Notification->create();
        return $Model->Notification->saveAll($notification);
    }

    /**
     * 
     * $notifications = $this->User->getUnreadNotification(1);
     * 
     * $this->User->id = 1;
     * $notifications = $this->User->getUnreadNotification();
     * 
     * $notifications = $this->User->getUnreadNotification(1, array('Notification.created >' => date()));
     * 
     */
    public function getUnreadNotification(Model $Model, $user_id = null, $conditions = array()) {
        if (empty($user_id))
            $user_id = $Model->id;
        return $Model->Notification->getUnread($user_id);
    }

    /**
     * 
     * $notifications = $this->User->getLastNotification(1, 5);
     */
    public function getLastNotification(Model $Model, $user_id, $limit = 5) {
        return $Model->Notification->getLast($user_id, $limit);
    }

}
