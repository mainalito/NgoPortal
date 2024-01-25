<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "past_passwords".
 *
 * @property int $lastpassId
 * @property int $id
 * @property string|null $password_hash
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int|null $createdBy
 */
class PastPasswords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'past_passwords';
    }

    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'past_passwords.deleted', 0]);
    }

    /**
     * Added by Paul Mburu
     * To be executed before delete
     */
    public function delete()
    {
        $m = parent::findOne($this->getPrimaryKey());
        $m->deleted = 1;
        $m->deletedTime = date('Y-m-d H:i:s');
        return $m->save();
    }
    /**
     * Added by Paul Mburu
     * To be executed before Save
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        //this record is always new
        if ($this->isNewRecord) {
            $this->createdTime = date('Y-m-d h:i:s');
        }
        return parent::save();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'password_hash'], 'required'],
            [['lastpassId', 'id', 'deleted', 'createdBy'], 'integer'],
            [['password_hash', 'comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['lastpassId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lastpassId' => 'Lastpass ID',
            'id' => 'ID',
            'password_hash' => 'Password Hash',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
    public function addPassword($userId, $password)
    {
        $model = new PastPasswords();
        $model->id = $userId;
        $model->password_hash = $password;
        return $model->save();
    }

}
