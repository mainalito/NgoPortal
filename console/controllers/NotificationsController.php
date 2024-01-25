<?php

namespace console\controllers;

use common\models\Notifications;
use yii\console\Controller;
use Yii;
use yii\filters\VerbFilter;

class NotificationsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionSendemail(){
        $notifications = Notifications::find()->andWhere(['notificationStatusId' => 1])->all();
        foreach ($notifications as $message){
            Yii::$app->mailer->sendEmail($message->email, $message->subject, $message->message);
            $message->notificationStatusId = 3;
            $message->save();
        }
    }
}
?>
