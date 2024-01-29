<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "task_approval".
 *
 * @property int $id
 * @property int|null $TaskTypeId
 * @property int|null $userId
 * @property int|null $statusId
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 * @property int|null $subjectId
 * @property string|null $subjectTitle
 */
class TaskApproval extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_approval';
    }
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
            [['TaskTypeId', 'userId', 'statusId', 'deleted', 'createdBy', 'subjectId'], 'integer'],
            [['comments', 'subjectTitle'], 'string'],
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
            'id' => 'ID',
            'TaskTypeId' => 'Task Type ID',
            'userId' => 'User ID',
            'statusId' => 'Status ID',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
            'subjectId' => 'Subject ID',
            'subjectTitle' => 'Subject Title',
        ];
    }

    public static function createTaskWorkflow($TaskTypeId, $subjectId, $subjectTitle, $userId)
    {
        $taskType = TaskType::findOne($TaskTypeId);
        if (!$taskType) {
            return false;
        }
        
        $task = new TaskApproval();
        $task->TaskTypeId = $TaskTypeId;
        $task->subjectId = $subjectId;
        $task->subjectTitle = $subjectTitle;
        $task->userId = $userId;
        if($task->save()){
            //TODO: SEND EMAIL TO THE ADMIN TO TELL THEM A NEW TASK HAS ARRIVED
        }
    }
    public function getTaskType(){
        return $this->hasOne(TaskType::className(), ['id' => 'TaskTypeId']);
    }
}
