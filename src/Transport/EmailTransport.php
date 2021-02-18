<?php

declare(strict_types=1);

namespace UserNotify\Transport;

# CAKEPHP

use Cake\Core\Configure;
use Cake\I18n\I18n;

# PLUGIN
use UserNotify\Transport\Transport;
use UserNotify\Transport\TransportInterface;
use UserNotify\Notification\EmailNotification;
use UserNotify\Notification\NotificationInterface;

class EmailTransport extends Transport implements TransportInterface {

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

        /**
         * @TODO 
         * Send email
         */
        $notification->email()->start($content);

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
        $notification = new EmailNotification();

        $beforeSendCallback = $notification->getBeforeSendCallback();
        self::_performCallback($beforeSendCallback, $notification);

        if ($notification->getLocale() !== null) {
            I18n::setLocale($notification->getLocale());
        } else {
            I18n::setLocale(Configure::read('UserNotify.defaultLocale'));
        }

        /**
         * @TODO 
         * Queue email
         */
        $afterSendCallback = $notification->getAfterSendCallback();
        self::_performCallback($afterSendCallback);

        return $notification;
    }

}
