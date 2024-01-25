<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "time_commitments".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $numberOfHours
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 *
 * @property JobListings[] $jobListings
 */
class TimeCommitments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_commitments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'comments'], 'string'],
            [['numberOfHours', 'deleted', 'createdBy'], 'integer'],
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
            'name' => 'Name',
            'description' => 'Description',
            'numberOfHours' => 'Number Of Hours',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[JobListings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobListings()
    {
        return $this->hasMany(JobListings::class, ['timeCommitmentId' => 'id']);
    }
}
