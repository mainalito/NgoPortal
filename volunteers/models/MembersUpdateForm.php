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
class MembersUpdateForm extends Model
{
    public $password;
    public $username;

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
            throw new InvalidArgumentException('Membership User ID cannot be blank.');
        }
        $this->_user = User::findOne($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong member.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'username'], 'required'],
            ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*\W)(?=.*[A-Z]).*$/', 'message' => 'Password must contain at least one lower and upper case character and a digit'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password', 'validate_password'],
        ];
    }

    public function validate_password($attribute)
    {
        $past_passwords = PastPasswords::find()->andWhere(['id' => $this->_user->id])->all();
        $count = false;
        foreach ($past_passwords as $past_password) {
            if (Yii::$app->security->validatePassword($this->password, $past_password->password_hash))
                $count = true;
        }
        if ($count)
            $this->addError($attribute, 'Password already used in the past choose another password.');
    }

    /**
     * Updates password and username
     *
     * @return bool if password and username was updated.
     */
    public function addPassword()
    {
        $user = $this->_user;
        $user->username = $this->username;
        $user->setPassword($this->password);
        // $user->status = 10;
        $user->generateAuthKey();

        if ($user->save())
            $model = new PastPasswords();
        return $model->addPassword($user->id, $user->password_hash);
        return false;
    }
}
