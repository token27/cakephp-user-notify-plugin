<?php

declare(strict_types=1);

namespace UserNotify\Controller;

# CAKEPHP

use App\Controller\AppController;
use Cake\Core\App;
use Cake\Http\Exception\NotFoundException;
use Cake\Event\EventInterface;

# PLUGIN 

/**
 * UsersAuthenticationController Controller
 *
 * @property \Queued\Model\Table\QueuedWorkersTable $QueuedWorkers 
 */
class UserNotifyController extends AppController {

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
     * 
     * @param \Cake\Event\EventInterface $event
     */
    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
    }

}
