<?php

namespace volunteers\models;

use common\models\PastPasswords;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $confirmPassword;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).*$/', 'message'=>'Password must contain at least one lower and upper case character and a digit'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['confirmPassword', 'required'],
            ['confirmPassword','compare','compareAttribute'=>'password','message'=>'Passwords do not match, try again'],

            ['password', 'validate_password'],
        ];
    }

    public function validate_password($attribute){
        $past_passwords = PastPasswords::find()->andWhere(['id' => $this->_user->id])->all();
        $count = false;
        foreach ($past_passwords as $past_password){
            if(Yii::$app->security->validatePassword($this->password, $past_password->password_hash))
                $count = true;
        }
        if ($count)
            $this->addError($attribute, 'Password already used in the past choose another password.');
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        if($user->save())
            $model = new PastPasswords();
            return $model->addPassword($user->id, $user->password_hash);
        return false;
    }
}
