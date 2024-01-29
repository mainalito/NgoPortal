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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['starttime', 'endtime', 'date', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['volunteerProfileId', 'deleted', 'createdBy'], 'integer'],
            [['description', 'comments'], 'string'],
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
}
