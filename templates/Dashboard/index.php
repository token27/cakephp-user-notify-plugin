<?php

/**
 * @var \App\View\AppView $this
 * @var \Queued\Model\Entity\QueuedTask[] $pendingDetails
 * @var string[] $tasks
 * @var string[] $servers
 * @var array $status
 * @var int $new
 * @var int $current
 * @var array $data
 */
use Cake\Core\Configure;
use UserNotify\Utility\Config;
?>

<?= $this->Html->script(['//code.jquery.com/jquery-3.5.1.min.js']) ?>
