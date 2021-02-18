<?php

declare(strict_types=1);

namespace UserNotify\Model\Table;

# CAKEPHP

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

# PLUGIN
use UserNotify\Utility\Config;

class UserNotifyTable extends Table {

    /**
     * set connection name
     *
     * @return string
     */
    public static function defaultConnectionName(): string {
        $connection = Config::defaultDatabaseConnection();
        if (!empty($connection)) {
            return $connection;
        }

        return parent::defaultConnectionName();
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);
    }

}
