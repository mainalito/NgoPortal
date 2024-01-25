<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "templates".
 *
 * @property int $templateId
 * @property string|null $templateName
 * @property string|null $subject
 * @property string|null $message
 * @property string|null $code
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int|null $createdBy
 */
class Templates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'templates';
    }

    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'templates.deleted', 0]);
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
            $this->deleted = 0;
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
            [['message', 'comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['deleted', 'createdBy'], 'integer'],
            [['templateName', 'subject'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'templateId' => 'Template ID',
            'templateName' => 'Template Name',
            'subject' => 'Subject',
            'message' => 'Message',
            'code' => 'Code',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'createdBy']);
    }
}
