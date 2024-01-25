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
    public $email;
    public $organizationTypeId;
    public $organizationName;
    public $contactPerson;
    public $phoneNumber;
    public $goamlId;
    public $password;
    public $confirmPassword;


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
            ['organizationName', 'trim'],
            ['organizationName', 'required'],
            ['organizationName', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This organization has already been registered.'],
            ['organizationName', 'string', 'min' => 2, 'max' => 255],

            ['contactPerson', 'string', 'min' => 2, 'max' => 255],

            ['phoneNumber', 'string', 'min' => 10, 'max' => 10],

            ['goamlId', 'string', 'min' => 2, 'max' => 50],

            [['contactPerson', 'organizationTypeId', 'phoneNumber', 'goamlId'], 'required'],
            ['goamlId', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This GoAML ID has already been registered.'],

            ['organizationTypeId', 'integer'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).*$/', 'message'=>'Password must contain at least one lower and upper case character and a digit'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['confirmPassword', 'required'],
            ['confirmPassword','compare','compareAttribute'=>'password','message'=>'Passwords do not match, try again'],
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
        $user->organizationTypeId = $this->organizationTypeId;
        $user->organizationName = $this->organizationName;
        $user->contactPerson = $this->contactPerson;
        $user->phoneNumber = $this->phoneNumber;
        $user->goamlId = $this->goamlId;
        $user->email = $this->email;
        $user->createdTime = date('Y-m-d H:i:s');
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
