<?php

namespace UserNotify\Utility;

use Cake\Core\App;
use Cake\Core\Configure;
use RuntimeException;

class Config {

    public function __constructor() {
        self::loadPluginConfiguration();
    }

    public static function loadPluginConfiguration() {
        if (file_exists(ROOT . DS . 'config' . DS . 'app_user_notify.php')) {
            Configure::load('app_user_notify');
        } else {
            Configure::load('UserNotify.app_user_notify');
        }
    }

    /**
     * Default log status
     * 
     * @return boolean
     */
    public static function defaultLog() {
        return Configure::read('UserNotify.log', false);
    }

    /**
     * User model
     * 
     * @return boolean
     */
    public static function defaultUserModel() {
        return Configure::read('UserNotify.userModel', 'UserAuth.Users');
    }

    /**
     * 
     * @return null|string
     */
    public static function defaultDatabaseConnection() {
        return Configure::read('UserNotify.database_connection', null);
    }

    /**
     * 
     * @return null|string
     */
    public static function twilioAccountSid() {
        return Configure::read('UserNotify.Twilio.accountSid', null);
    }

    /**
     * 
     * @return null|string
     */
    public static function twilioAuthToken() {
        return Configure::read('UserNotify.Twilio.authToken', null);
    }

}
