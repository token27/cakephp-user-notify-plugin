<?php

namespace UserNotify;

# CAKEPHP

use Cake\Core\BasePlugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Core\PluginApplicationInterface;
use Cake\Core\Configure;
use Cake\Http\Middleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\TableRegistry;
use Cake\Core\Exception;

# PLUGIN
use UserNotify\Utility\Config;

/**
 * Plugin for Queue
 */
class Plugin extends BasePlugin {
    /**
     * @var bool
     */
//    protected $middlewareEnabled = false;

    /**
     * Load all the plugin configuration and bootstrap logic.
     *
     * The host application is provided as an argument. This allows you to load
     * additional plugin dependencies, or attach events.
     *
     * @param \Cake\Core\PluginApplicationInterface $app The host application
     * @return void
     */
    public function bootstrap(PluginApplicationInterface $app): void {

        /**
         * @TODO Check if already loaded
         */
        $app->addPlugin('UserAuth');

        /**
         * @note Optionally load additional queued config defaults from local app config
         */
        Config::loadPluginConfiguration();

//        $this->_attachBehaviorNotifiableToTable(UserNotifyConfig::defaultUserModel());
    }

    /**
     * Add routes for the plugin.
     *
     * If your plugin has many routes and you would like to isolate them into a separate file,
     * you can create `$plugin/config/routes.php` and delete this method.
     *
     * @param \Cake\Routing\RouteBuilder $routes The route builder to update.
     * @return void
     */
    public function routes(RouteBuilder $routes): void {

        $routes->plugin(
                'UserNotify',
                ['path' => '/users-notifications'],
                function (RouteBuilder $builder) {

            $builder->connect('/', ['controller' => 'Dashboard', 'actions' => 'index']);
            /**
             * AJAX
             * 
             * [DOMAIN.TDL]/users-notifications/ajax
             */
//            $builder->prefix('ajax', function (RouteBuilder $builder_prefix_ajax) {
//
//                $builder_prefix_ajax->connect('/', ['prefix' => 'Ajax', 'controller' => 'Home', 'action' => 'index']);
//
//                $builder_prefix_ajax->connect('/notallowed/*', ['prefix' => 'Ajax', 'controller' => 'Home', 'action' => 'notallowed']);
//                $builder_prefix_ajax->connect('/welcome/*', ['prefix' => 'Ajax', 'controller' => 'Home', 'action' => 'welcome']);
//
//                /**
//                 * @endpoint users
//                 */
//                $builder_prefix_ajax->prefix('users', function (RouteBuilder $builder_prefix_ajax_users) {
//
//                    $builder_prefix_ajax_users->connect('/', ['prefix' => 'Ajax', 'controller' => 'Users', 'action' => 'index']);
//                    $builder_prefix_ajax_users->connect('/list/*', ['prefix' => 'Ajax', 'controller' => 'Users', 'action' => 'list']);
//
//                    $builder_prefix_ajax_users->connect('/login/*', ['prefix' => 'Ajax', 'controller' => 'Users', 'action' => 'login']);
//                    $builder_prefix_ajax_users->connect('/token/*', ['prefix' => 'Ajax', 'controller' => 'Users', 'action' => 'token']);
//                    $builder_prefix_ajax_users->connect('/logout/*', ['prefix' => 'Ajax', 'controller' => 'Users', 'action' => 'logout']);
//
//                    $builder_prefix_ajax_users->connect('/add/*', ['prefix' => 'Ajax', 'controller' => 'Users', 'action' => 'add']);
//                    $builder_prefix_ajax_users->connect('/remove/*', ['prefix' => 'Ajax', 'controller' => 'Users', 'action' => 'remove']);
//                });
//            });

            $builder->fallbacks();
        }
        );
        parent::routes($routes);
    }

    /**
     * Add middleware for the plugin.
     *
     * @param \Cake\Http\MiddlewareQueue $middleware The middleware queue to update.
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue {


        return $middlewareQueue;
    }

    private function _attachBehaviorNotifiableToTable(string $table_name) {
        $table = TableRegistry::get($table_name);
        if ($table) {
            $table->addBehavior('UserNotify.Notifiable');
        }
    }

}
