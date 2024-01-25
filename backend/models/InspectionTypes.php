<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "inspection_types".
 *
 * @property int $inspectionTypeId
 * @property string|null $inspectionTypeName
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deleteTime
 * @property int|null $createdBy
 */
class InspectionTypes extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inspection_types';
    }

    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'inspection_types.deleted', 0]);
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
            [['comments'], 'string'],
            [['createdTime', 'updatedTime', 'deleteTime'], 'safe'],
            [['deleted', 'createdBy'], 'integer'],
            [['inspectionTypeName'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inspectionTypeId' => 'Inspection Type ID',
            'inspectionTypeName' => 'Inspection Type Name',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deleteTime' => 'Delete Time',
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
        return $this->hasOne(User::className(),['id' => 'createdBy']);
    }
}
