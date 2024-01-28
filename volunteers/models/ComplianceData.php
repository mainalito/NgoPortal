<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compliance_data".
 *
 * @property int $dataId
 * @property int|null $submissionId
 * @property int|null $matrixId
 * @property string|null $value
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class ComplianceData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compliance_data';
    }

    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'compliance_data.deleted', 0]);
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
            [['submissionId', 'matrixId', 'deleted', 'createdBy'], 'integer'],
            [['value', 'comments'], 'string'],
            [['createdTime', 'createdBy'], 'required'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dataId' => 'Data ID',
            'submissionId' => 'Submission ID',
            'matrixId' => 'Matrix ID',
            'value' => 'Value',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
}
