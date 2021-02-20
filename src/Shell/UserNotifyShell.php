<?php

namespace UserNotify\Shell;

# CAKEPHP

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\FrozenTime;
use Cake\I18n\Number;
use Cake\Log\Log;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use RuntimeException;
use Throwable;

# PLUGIN 
use UserNotify\Utility\NotificationManager;

declare(ticks=1);

class UserNotifyShell extends Shell {

    /**
     * Get option parser method to parse commandline options
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser(): ConsoleOptionParser {

        $parser = parent::getOptionParser();


        $options_add = [];
        $options_add['title'] = [
            'long' => 'title',
            'help' => 'The title for the notification.',
            'default' => false,
        ];
        $options_add['message'] = [
            'long' => 'message',
            'help' => 'The message for the notification.',
            'default' => null,
        ];
        $options_add['subject-model'] = [
            'long' => 'subject-model',
            'help' => 'The mode name for the notification.',
            'default' => null,
        ];
        $options_add['subject-id'] = [
            'long' => 'subject-id',
            'help' => 'The model id for the notification.',
            'default' => null,
        ];

        $options_add['data'] = [
            'long' => 'data',
            'help' => 'The additional data for the notification. (Must be in JSON format)',
            'default' => null,
        ];
        $parser->addSubcommand('add', [
            'help' => __('Add new notification.'),
            'parser' => [
                'description' => [
                    __('Use this command to ADD notification to a user.'),
                ],
                'options' => $options_add,
                'arguments' => [
                    'notificationtype' => [
                        'help' => __('The notificaion type to add.'),
                        'required' => false,
                        'choices' => [
                            'database',
                            'web',
                            'email',
                            'push',
                            'sms'
                        ]
                    ],
                    'user' => [
                        'help' => __('The user id/username to send the notification.'),
                        'required' => false
                    ],
                ],
            ]
        ]);


        return $parser;
    }

    /**
     * Overwrite shell initialize to dynamically load all Queue Related Tasks.
     *
     * @return void
     */
    public function initialize(): void {
        parent::initialize();
//        $this->loadModel('Queued.QueuedTasks');
//        $this->loadModel('Queued.QueuedWorkers');
    }

    /**
     * Main
     *
     * @access public
     */
    public function main() {
        $this->out($this->OptionParser->help());
        return true;
    }

    /**
     *
     * @return void
     */
    public function add() {
//        if (count($this->args) < 1) {
//            $this->out('Please call like this:');
//            $this->out('    bin/cake users_notifications add <notification-type> <user> --title --message --subject-model --subject-id');
//            return;
//        }
        $model = null;
        $model_id = null;

        $user_id = null;
        $title = "";
        $body = null;
        $place = null;
        $additional_data = [];
    }

}
