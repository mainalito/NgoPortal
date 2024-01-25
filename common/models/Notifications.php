<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $notificationId
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $message
 * @property int|null $notificationStatusId
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notificationId', 'notificationStatusId', 'deleted', 'createdBy'], 'integer'],
            [['message', 'comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['email'], 'string', 'max' => 150],
            [['subject'], 'string', 'max' => 255],
            [['notificationId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'notificationId' => 'Notification ID',
            'email' => 'Email',
            'subject' => 'Subject',
            'message' => 'Message',
            'notificationStatusId' => 'Notification Status ID',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
    public function sendMessage($templateCode, $email, $parameters = []){
        $template = Templates::findOne(['code' => $templateCode]);
        if (!$template){
            return false;
        }
        $msg = $template->message;
        foreach ($parameters as $key => $value){
            $msg = str_replace("#$key#",$value,$msg);
        }
        $this->message = $msg;
        $this->email = $email;
        $this->subject = $template->subject;
        $this->notificationStatusId = 1;
        return $this->save();
    }
}
