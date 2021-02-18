<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property string $id
 * @property string $user_id
 * @property string $type
 * @property string $title
 * @property string|null $body
 * @property string|null $additional_data
 * @property int $readed
 * @property string $timezone
 * @property int $sent
 * @property \Cake\I18n\FrozenTime|null $send_on
 * @property \Cake\I18n\FrozenTime|null $sent_on
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property int $subject_count
 * @property int $feedback_count
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Feedback[] $feedbacks
 * @property \App\Model\Entity\Subject[] $subjects
 */
class Notification extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

}
