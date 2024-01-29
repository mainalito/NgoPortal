<?php

namespace backend\models;

use Yii;
use backend\models\TimeCommitments;

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
            [['timeCommitmentId'], 'exist', 'skipOnError' => true, 'targetClass' => \backend\models\TimeCommitments::class, 'targetAttribute' => ['timeCommitmentId' => 'id']],
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
            'timeCommitmentId' => 'Time Commitment ',
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
     * Gets query for [[TimeCommitment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimeCommitment()
    {
        return $this->hasOne(\backend\models\TimeCommitments::class, ['id' => 'timeCommitmentId']);
    }
}
