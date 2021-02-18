<?php

namespace UserNotify\Notification;

use UserNotify\Notification\NotificationInterface;
use UserNotify\Notification\Notification;
use UserNotify\Transport\FcmTransport;
use UserNotify\Adapter\FcmAdapter;

class FcmNotification extends Notification {

    /**
     * Transport class
     *
     * @var string
     */
    protected $_transport = '\UserNotify\Transport\FcmTransport';

    /**
     * Fcm object
     *
     * @var \Cake\Mailer\Email
     */
    protected $_fcm;

    /**
     * Constructor
     *
     * @param array|null $config Config
     */
    public function __construct(?array $config = null) {
        parent::__construct();
        $this->_fcm = new FcmAdapter($config);
    }

    /**
     * Push the Notification into the queue
     *
     * @param string|array|null $content String with message or array with messages
     * @return \Notifications\Notification\NotificationInterface
     */
    public function queue($content = null): NotificationInterface {
        return FcmTransport::queueNotification($this, $content);
    }

    /**
     * Send the EmailNotification immediately using the corresponding transport class
     *
     * @param string|array|null $content String with message or array with messages
     * @return \Notifications\Notification\NotificationInterface
     */
    public function send($content = null): NotificationInterface {
        return FcmTransport::sendNotification($this, $content);
    }

    public function fcm(): FcmAdapter {
        return $this->_fcm;
    }

    /**
     * Overload Fcm functions
     *
     * @param string $name method name
     * @param array  $args arguments
     * @return \Notifications\Notification\FcmNotification
     */
    public function __call(string $name, array $args): FcmNotification {
        call_user_func_array([$this->_fcm, $name], $args);

        return $this;
    }

}
