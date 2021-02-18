<?php

declare(strict_types=1);

namespace UserNotify\Transport;

# CAKEPHP

use Cake\Core\Configure;
use Cake\I18n\I18n;

# PLUGIN
use UserNotify\Transport\Transport;
use UserNotify\Transport\TransportInterface;
use UserNotify\Notification\DatabaseNotification;
use UserNotify\Notification\NotificationInterface;
#TODO database adapter for notifications
use UserNotify\Adapter\NotificationDatabaseAdapter;

class DatabaseTransport extends Transport implements TransportInterface {

    /**
     * Send function
     *
     * @param \Notifications\Notification\NotificationInterface $notification Notification object
     * @param string|array|null $content String with message or array with messages
     * @return \Notifications\Notification\NotificationInterface
     */
    public static function sendNotification(NotificationInterface $notification, $content = null): NotificationInterface {
        $beforeSendCallback = $notification->getBeforeSendCallback();
        self::_performCallback($beforeSendCallback, $notification);

        if ($notification->getLocale() !== null) {
            I18n::setLocale($notification->getLocale());
        } else {
            I18n::setLocale(Configure::read('UserNotify.defaultLocale'));
        }

        debug($notification);
        exit();
        /**
         * @TODO 
         * Send in the database
         * parse the $content
         */
//        $notification->database();
//        $notification->fcm()->send();

        $afterSendCallback = $notification->getAfterSendCallback();
        self::_performCallback($afterSendCallback);

        return $notification;
    }

    /**
     * Process the job coming from the queue
     *
     * @param \Notifications\Notification\NotificationInterface $notification Notification object
     * @param string|array|null $content String with message or array with messages
     * @return \Notifications\Notification\NotificationInterface
     */
    public static function queueNotification(NotificationInterface $notification, $content = null): NotificationInterface {
        $notification = new DatabaseNotification();

        $beforeSendCallback = $notification->getBeforeSendCallback();
        self::_performCallback($beforeSendCallback, $notification);

        if ($notification->getLocale() !== null) {
            I18n::setLocale($notification->getLocale());
        } else {
            I18n::setLocale(Configure::read('UserNotify.defaultLocale'));
        }

        /**
         * @TODO 
         * Save in to database
         */
        $afterSendCallback = $notification->getAfterSendCallback();
        self::_performCallback($afterSendCallback);

        return $notification;
    }

}
