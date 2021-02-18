<?php

namespace UserNotify\View\Helper;

use Cake\Datasource\ModelAwareTrait;
use Cake\View\Helper;

//use Queued\Model\Entity\QueuedTask;
//use Queued\Queued\Config;
//use Queued\Queued\TaskFinder;

/**
 * @property \Queue\Model\Table\QueuedTasksTable $QueuedTasks
 */
class UserNotifyHelper extends Helper {

    use ModelAwareTrait;
    
}
