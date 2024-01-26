<?php

namespace frontend\models;

use common\models\Notifications;
use common\models\PastPasswords;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\Html;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $firstname;
    public $othernames;
    public $lastnames;
    public $email;
    public $createdBy;

    public $password;
    public $created_at;
    public $updated_at;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 100],


            [['firstname', 'othernames', 'lastnames'], 'required'],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).*$/', 'message'=>'Password must contain at least one lower and upper case character and a digit'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'firstname' => 'First Name',
            'othernames' => 'Other Name',
            'lastnames' => 'Last Name',
            'email' => 'Email',
            'membershipProfileId' => 'Membership Profile ID',
            'password' => 'Password',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->firstname = $this->firstname;
        $user->othernames = $this->othernames;
        $user->lastnames = $this->lastnames;
        $user->email = $this->email;
        $user->createdTime = date('Y-m-d H:i:s');
        $user->createdBy = 0;
        $user->status = User::STATUS_INACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if($user->save()) {
            $model = new PastPasswords();
            $model->addPassword($user->id, $user->password_hash);
            return $this->sendEmail($user);
        }
        return false;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        $notification = new Notifications();
        $verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
        $link = Html::a('link', $verifyLink,['class' => 'btn btn-sm btn-success']);
        return $notification->sendMessage('VERIFY-EMAIL', $user->email, $parameters = ['FullName' => $user->organizationName, 'Link' => $link]);
    }
}
