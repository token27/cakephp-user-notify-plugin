<?php

namespace UserNotify\Notification;

use UserNotify\Notification\NotificationInterface;
use UserNotify\Notification\Notification;
use UserNotify\Transport\DatabaseTransport;
use UserNotify\Adapter\NotificationDatabaseAdapter;

class DatabaseNotification extends Notification {

    /**
     * Transport class
     *
     * @var string
     */
    protected $_transport = '\UserNotify\Transport\DatabaseTransport';

    /**
     * Fcm object
     *
     * @var \Cake\Mailer\Email
     */
    protected $_database_adapter;

    /**
     * Constructor
     *
     * @param array|null $config Config
     */
    public function __construct(?array $config = null) {
        parent::__construct();
        $this->_database_adapter = new NotificationDatabaseAdapter($config);
    }

    /**
     * Push the Notification into the queue
     *
     * @param string|array|null $content String with message or array with messages
     * @return \Notifications\Notification\NotificationInterface
     */
    public function queue($content = null): NotificationInterface {
        return DatabaseTransport::queueNotification($this, $content);
    }

    /**
     * Send the EmailNotification immediately using the corresponding transport class
     *
     * @param string|array|null $content String with message or array with messages
     * @return \Notifications\Notification\NotificationInterface
     */
    public function send($content = null): NotificationInterface {
        return DatabaseTransport::sendNotification($this, $content);
    }

    public function database(): NotificationDatabaseAdapter {
        return $this->_database_adapter;
    }

    /**
     * Overload Model functions
     *
     * @param string $name method name
     * @param array  $args arguments
     * @return \Notifications\Notification\DatabaseNotification
     */
    public function __call(string $name, array $args): DatabaseNotification {
        call_user_func_array([$this->_database_adapter, $name], $args);

        return $this;
    }

}
