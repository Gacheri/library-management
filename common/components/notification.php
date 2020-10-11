<?php
namespace common\components;
use Yii;
use common\models\User;//example models
use common\models\Message;//example models
use machour\yii2\notifications\models\Notification as BaseNotification;
class Notification extends BaseNotification
{

    /**
     * A new message notification
     */
    const KEY_NEW_MESSAGE = 'new_message';
    /**
     * A meeting reminder notification
     */
    const KEY_REQUEST_BOOK = 'student_request';
    /**
     * No disk space left !
     */
    const KEY_APPROVE_BOOK = 'librarian_approve';

    /**
     * @var array Holds all usable notifications
     */
    public static $keys = [
        self::KEY_NEW_MESSAGE,
        self::KEY_REQUEST_BOOK,
        self::KEY_APPROVE_BOOK,
    ];

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        switch ($this->key) {
            case self::KEY_NEW_MESSAGE:
                return Yii::t('app', 'Meeting reminder');

            case self::KEY_REQUEST_BOOK:
                return Yii::t('app', 'You got a new message');

            case self::KEY_APPROVE_BOOK:
                return Yii::t('app', 'No disk space left');
        }
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        switch ($this->key) {
            case self::KEY_REQUEST_BOOK:
                $meeting = Meeting::findOne($this->key_id);
                return Yii::t('app', 'You are meeting with {customer}', [
                    'customer' => $meeting->customer->name
                ]);

            case self::KEY_NEW_MESSAGE:
                $message = Message::findOne($this->key_id);
                return Yii::t('app', '{customer} sent you a message', [
                    'customer' => $meeting->customer->name
                ]);

            case self::KEY_APPROVE_BOOK:
                // We don't have a key_id here, simple message
                return 'Please buy more space immediately';
        }
    }

    /**
     * @inheritdoc
     */
    public function getRoute()
    {
        switch ($this->key) {
            case self::KEY_REQUEST_BOOK:
                return ['meeting', 'id' => $this->key_id];

            case self::KEY_NEW_MESSAGE:
                return ['message/read', 'id' => $this->key_id];

            case self::KEY_APPROVE_BOOK:
                return 'https://aws.amazon.com/';//simple route on external link
        };
    }

}