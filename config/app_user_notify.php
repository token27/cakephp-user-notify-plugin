<?php

/**
 * This file configures default behavior for all workers
 *
 * To modify these parameters, copy this file into your own CakePHP config directory or copy the array into your existing file.
 */
return [
    'UserNotify' => [
        /**
         * Default plugin locale
         */
        'defaultLocale' => 'en_US',
        /**
         *  Determine whether logging is enabled
         */
        'log' => false,
        /**
         *  The Users Model
         */
        'userModel' => 'UserAuth.Users',
        /**
         * The database connection
         */
        'database_connection' => null,
        /**
         * Twilio account settings
         */
        'Twilio' => [
            'accountSid' => null,
            'authToken' => null,
        ],
        /**
         * Emails templates
         */
        'EmailTemplates' => [
            'welcome' => [
                'title' => 'New User: :name',
                'body' => 'The user :email has been registered'
            ],
        ],
        /**
         * Notifications Groups
         */
        'Groups' => [
            'admins' => [],
            'webmasters' => [],
        ],
        /**
         * FCM
         */
        'Fcm' => [
            'url' => null,
            'api' => null,
            'icon' => null,
        ],
    ],
];
