<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "administrative_actions".
 *
 * @property int $actionId
 * @property string|null $actionName
 * @property int|null $hasAmount
 * @property int|null $hasText
 * @property int|null $can_create_case
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class AdministrativeActions extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrative_actions';
    }

    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'administrative_actions.deleted', 0]);
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
            $this->createdBy = Yii::$app->user->identity->id;
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
            [['hasAmount', 'hasText', 'can_create_case', 'deleted', 'createdBy'], 'integer'],
            [['comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['createdBy'], 'required'],
            [['actionName'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'actionId' => 'Action ID',
            'actionName' => 'Administrative Action',
            'hasAmount' => 'Has Amount',
            'hasText' => 'Has Text',
            'can_create_case' => 'Can Create Case',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    public function getRequireAmount()
    {
        if ($this->hasAmount)
            return 'Yes';
        return 'No';
    }

    public function getRequireText()
    {
        if ($this->hasText)
            return 'Yes';
        return 'No';
    }

    public function getCanInitiateCase()
    {
        if ($this->can_create_case)
            return 'Yes';
        return 'No';
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
