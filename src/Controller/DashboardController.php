<?php

declare(strict_types=1);

namespace UserNotify\Controller;

use Cake\Core\Configure;
//use Queued\Queued\Config;
# PLUGIN
use UserNotify\Notification\DatabaseNotification;

/**
 * Dashboard Controller 
 */
class DashboardController extends UserNotifyController {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $notification = new DatabaseNotification();

//        $notification->good();
//        exit();
    }

}
