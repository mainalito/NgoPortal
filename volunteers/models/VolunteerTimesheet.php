<?php

namespace volunteers\models;

use Yii;

/**
 * This is the model class for table "volunteer_timesheet".
 *
 * @property int $id
 * @property string|null $starttime
 * @property string|null $endtime
 * @property string|null $date
 * @property int|null $volunteerProfileId
 * @property string|null $description
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class VolunteerTimesheet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'volunteer_timesheet';
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
        
            [['starttime', 'endtime'], 'date', 'format' => 'php:H:i'],
            [['starttime'], 'compare', 'compareAttribute' => 'endtime', 'operator' => '<', 'message' => 'Start time must be earlier than end time'],
            [['starttime', 'endtime', 'date', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['volunteerProfileId', 'deleted', 'createdBy'], 'integer'],
            [['description', 'comments'], 'string'],
            [['createdTime', 'createdBy','starttime', 'endtime'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'starttime' => 'Starttime',
            'endtime' => 'Endtime',
            'date' => 'Date',
            'volunteerProfileId' => 'Volunteer Profile ID',
            'description' => 'Description',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
    public function getJob()
    {
        return $this->hasOne(JobListings::className(), ['ID' => 'jobId']);
    }
}
