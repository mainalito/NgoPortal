<?php

namespace volunteers\models;

use Yii;

/**
 * This is the model class for table "job_application".
 *
 * @property int $id
 * @property int|null $volunteerProfileId
 * @property int|null $jobListingId
 * @property int|null $approvalStatusId
 * @property string|null $cv
 * @property string|null $coverLetter
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 *
 * @property ApprovalStatus $approvalStatus
 * @property JobListings $jobListing
 * @property VolunteerProfile $volunteerProfile
 */
class JobApplication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['volunteerProfileId', 'jobListingId', 'approvalStatusId', 'deleted', 'createdBy'], 'integer'],
            [[ 'coverLetter', 'comments'], 'string'],
            [['createdTime', 'createdBy'], 'required'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['volunteerProfileId'], 'exist', 'skipOnError' => true, 'targetClass' => VolunteerProfile::class, 'targetAttribute' => ['volunteerProfileId' => 'id']],
            [['approvalStatusId'], 'exist', 'skipOnError' => true, 'targetClass' => ApprovalStatus::class, 'targetAttribute' => ['approvalStatusId' => 'id']],
            [['jobListingId'], 'exist', 'skipOnError' => true, 'targetClass' => JobListings::class, 'targetAttribute' => ['jobListingId' => 'id']],
            [['cv'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, jpg, gif, png, docx, doc, xlx, xlsx', 'maxFiles' => 10],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'volunteerProfileId' => 'Volunteer Profile ID',
            'jobListingId' => 'Job Listing ID',
            'approvalStatusId' => 'Status',
            'cv' => 'Cv',
            'coverLetter' => 'Cover Letter',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[ApprovalStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprovalStatus()
    {
        return $this->hasOne(ApprovalStatus::class, ['id' => 'approvalStatusId']);
    }

    /**
     * Gets query for [[JobListing]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobListing()
    {
        return $this->hasOne(JobListings::class, ['id' => 'jobListingId']);
    }

    /**
     * Gets query for [[VolunteerProfile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVolunteerProfile()
    {
        return $this->hasOne(VolunteerProfile::class, ['id' => 'volunteerProfileId']);
    }
}
