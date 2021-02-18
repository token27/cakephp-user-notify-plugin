<?php

namespace UserNotify\Adapter;

# CAKEPHP

use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\Http\Client\Message;
use Cake\Utility\Hash;
use Cake\ORM\TableRegistry;
# PLUGIN
use UserNotify\Adapter\NotificationAbstractAdapter;
use UserNotify\Utility\Config;

# OTHERS

class NotificationDatabaseAdapter extends NotificationAbstractAdapter {

    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';

    /**
     * Default config
     *
     * @var array
     */
    protected $_defaultConfig = [
        'subjects' => [
            'Users'
        ],
    ];

    /**
     *
     * @var  \UsersAuthentication\Model\Table\UsersTable|App\Model\Table\UsersTable
     */
    protected $_tableUsers;

    /**
     *
     * @var \UserNotify\Model\Table\NotificationsTable
     */
    protected $_tableNotifications;

    /**
     *
     * @var \UserNotify\Model\Table\SubjectsTable 
     */
    protected $_tableSubjects;

    /**
     * Array for the notification
     *
     * @var array
     */
    protected $notification = [];

    /**
     * 
     *
     * @var 
     */
    protected $entityNotification;

    /**
     * Array of subjects of the notification
     *
     * @var array
     */
    protected $subjects = [];

    /**
     * List of keys allowed to be used in notification array.
     *
     * @var array
     */
    protected $_allowedNotificationKeys = [
        'title',
        'body',
        'additional_data',
    ];

    /**
     * List of keys allowed to be used in subject array.
     *
     * @var array
     */
    protected $_allowedSubjectKeys = [
        'user_id',
        'notification_id',
        'model',
        'model_id',
    ];

    /**
     * DatabaseAdapter constructor.
     *
     * @throws \Exception
     */
    public function __construct($config = null) {
        parent::__construct($config);
        $config = $this->getConfig();

        $this->_tableUsers = TableRegistry::get(Config::defaultUserModel());

        $this->_tableNotifications = TableRegistry::get('UserNotify.Notifications');

        $this->_tableSubjects = TableRegistry::get('UserNotify.Notifications');
    }

    /**
     * Execute the push
     *
     * @return boolean
     */
    public function send() {
        $build_notificaiton = $this->_buildNotification();
        if ($build_notificaiton) {
            try {
                $notification_saved = $this->_saveNotification();
                return empty($notification_saved) ? false : true;
            } catch (InvalidArgumentException $ex) {
                
            }
        }
        return false;
    }

    /**
     * Build the message
     *
     * @return boolean     
     */
    private function _buildNotification() {
        $data_notification = $this->getNotification();
        if (!empty($data_notification)) {
            try {
                $this->entityNotification = $this->_tableNotifications->newEntity($data_notification);
                return !empty($this->entityNotification);
            } catch (\Exception $ex) {
                
            }
        }
        return false;
    }

    /**
     * 
     *
     * @throws \InvalidArgumentException
     */
    private function _saveNotification() {
        if ($this->entityNotification === null) {
            throw new \InvalidArgumentException('Invalid entity notification.');
        }
        $notification_entity = $this->_tableNotifications->saveOrFail($this->entityNotification);
        $subjects = $this->getSubjects();
        if (!empty($subjects)) {
            
        }
    }

    /**
     * Getter for notification
     *
     * @return array
     */
    public function getNotification() {
        return $this->notification;
    }

    /**
     * Setter for notification
     *
     * @param array $notification Array of keys for the notification
     *
     * @return $this
     */
    public function setNotification(array $notification) {
        $this->_checkNotification($notification);
        $this->notification = $notification;
        return $this;
    }

    /**
     * Check notification's array
     *
     * @param array $notification Notification's array
     *
     * @throws \InvalidArgumentException
     */
    private function _checkNotification(array $notification) {
        if (empty($notification) || !isset($notification['title'])) {
            throw new \InvalidArgumentException('Array must contain at least a key title.');
        }

        $notAllowedKeys = [];
        foreach ($notification as $key => $value) {
            if (!\in_array($key, $this->_allowedNotificationKeys, true)) {
                $notAllowedKeys[] = $key;
            }
        }

        if (!empty($notAllowedKeys)) {
            $notAllowedKeys = implode(', ', $notAllowedKeys);
            throw new \InvalidArgumentException("The following keys are not allowed: {$notAllowedKeys}");
        }
    }

    /**
     * Build the message
     *
     * @return boolean     
     */
    private function _buildSubjects() {
        if (!empty($this->entityNotification)) {
            try {
                
            } catch (Exception $ex) {
                
            }
        }

        return false;
    }

    /**
     * Getter for parameters
     *
     * @return array
     */
    public function getSubjects() {
        return $this->subjects;
    }

    /**
     * Setter for parameters
     *
     * @param array $subjects Array of parameters for the push
     *
     * @return $this
     */
    public function setSubjects(array $subjects) {
        $this->_checkSubjects($subjects);
        $this->subjects = Hash::merge($this->getConfig('subjects'), $subjects);
        return $this;
    }

    /**
     * 
     * @param array $subject
     * @return $this
     */
    public function addSubject(array $subject) {
        $this->_checkSubject($subject);
        $subjects = $this->getSubjects();
        $subjects[] = $subject;
        return $this->setSubjects($subjects);
    }

    /**
     * Check notification's array
     *
     * @param array $subject Subject's array
     *
     * @throws \InvalidArgumentException
     */
    private function _checkSubject(array $subject) {
        if (empty($subject) || !isset($subject['model']) || !isset($subject['model_id']) || !isset($subject['notification_id'])) {
            throw new \InvalidArgumentException('Array must contain at least a keys "notification_id", "model" and "model_id".');
        } else
            $notAllowedKeys = [];
        foreach ($subject as $key => $value) {
            if (!\in_array($key, $this->_allowedSubjectKeys, true)) {
                $notAllowedKeys[] = $key;
            }
        }

        if (!empty($notAllowedKeys)) {
            $notAllowedKeys = implode(', ', $notAllowedKeys);
            throw new \InvalidArgumentException("The following keys are not allowed: {$notAllowedKeys}");
        }
    }

    /**
     * Check parameters's array
     *
     * @param array $subjects Parameters's array
     *
     * @throws InvalidArgumentException
     */
    private function _checkSubjects(array $subjects) {
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $this->_checkSubject($subject);
            }
        }
    }

}
