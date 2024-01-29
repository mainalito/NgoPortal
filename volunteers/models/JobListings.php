<?php

namespace volunteers\models;

use Yii;

/**
 * This is the model class for table "job_listings".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $timeCommitmentId
 * @property string|null $requirements
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 *
 * @property JobApplication[] $jobApplications
 * @property TimeCommitments $timeCommitment
 */
class JobListings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_listings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'requirements', 'comments'], 'string'],
            [['timeCommitmentId', 'deleted', 'createdBy'], 'integer'],
            [['createdTime', 'createdBy'], 'required'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['timeCommitmentId'], 'exist', 'skipOnError' => true, 'targetClass' => TimeCommitments::class, 'targetAttribute' => ['timeCommitmentId' => 'id']],
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
            'timeCommitmentId' => 'Time Commitment ID',
            'requirements' => 'Requirements',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[JobApplications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobApplications()
    {
        return $this->hasMany(JobApplication::class, ['jobListingId' => 'id']);
    }

    /**
     * Gets query for [[TimeCommitment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimeCommitment()
    {
        return $this->hasOne(TimeCommitments::class, ['id' => 'timeCommitmentId']);
    }
}