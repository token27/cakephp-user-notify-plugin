<?php

namespace UserNotify\Notification;

use Cake\Mailer\Email;
//use Josegonzalez\CakeQueuesadilla\Queue\Queue;
use UserNotify\Notification\NotificationInterface;
use UserNotify\Transport\EmailTransport;
use UserNotify\Notification\Notification;

/**
 * @method \Cake\Mailer\Email unserialize(string $data)
 */
class EmailNotification extends Notification {

    /**
     * Transport class
     *
     * @var string
     */
    protected $_transport = '\UserNotify\Transport\EmailTransport';

    /**
     * Cake Email object
     *
     * @var \Cake\Mailer\Email
     */
    protected $_email;

    /**
     * Constructor
     *
     * @param array|null $config Config
     */
    public function __construct(?array $config = null) {
        parent::__construct();
        $this->_email = new Email($config);
    }

    /**
     * {@inheritdoc}
     */
    public function queue($content = null): NotificationInterface {
        return EmailTransport::queueNotification($this, $content);
//        return Queue::push($this->_transport . '::queueNotification', [
//                    'email' => $this->_email->serialize(),
//                    'beforeSendCallback' => $this->_beforeSendCallback,
//                    'afterSendCallback' => $this->_afterSendCallback,
//                    'locale' => $this->_locale,
//                        ], $this->_queueOptions);
    }

    /**
     * Send the EmailNotification immediately using the corresponding transport class
     *
     * @param string|array|null $content String with message or array with messages
     * @return \Notifications\Notification\NotificationInterface
     */
    public function send($content = null): NotificationInterface {
        return EmailTransport::sendNotification($this, $content);
    }

    /**
     * Get the Cake Email object
     *
     * @return \Cake\Mailer\Email
     */
    public function email(): Email {
        return $this->_email;
    }

    /**
     * Overload Cake\Mailer\mail functions
     *
     * @param string $name method name
     * @param array  $args arguments
     * @return \Notifications\Notification\EmailNotification
     */
    public function __call(string $name, array $args): EmailNotification {
        call_user_func_array([$this->_email, $name], $args);

        return $this;
    }

}
