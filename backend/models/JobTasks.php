<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_tasks".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $dueDate
 * @property string|null $trainingMaterialsAndGuidlines
 * @property string|null $documents
 * @property int|null $jobListingId
 * @property int|null $volunteerProfileId
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class JobTasks extends \yii\db\ActiveRecord
{
    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'deleted', 0]);
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
    public static function tableName()
    {
        return 'job_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'trainingMaterialsAndGuidlines', 'documents', 'comments'], 'string'],
            [['dueDate', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['jobListingId', 'volunteerProfileId', 'deleted', 'createdBy'], 'integer'],
            [['createdTime', 'createdBy'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'dueDate' => 'Due Date',
            'trainingMaterialsAndGuidlines' => 'Training Materials And Guidlines',
            'documents' => 'Documents',
            'jobListingId' => 'Job Listing ID',
            'volunteerProfileId' => 'Volunteer Profile ID',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
}
