<?php

namespace volunteers\models;

use Yii;

/**
 * This is the model class for table "volunteer_skills".
 *
 * @property int $id
 * @property int|null $skillsId
 * @property string|null $description
 * @property int|null $volunteerProfileId
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class VolunteerSkills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'volunteer_skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skillsId', 'volunteerProfileId', 'deleted', 'createdBy'], 'integer'],
            [['description', 'comments'], 'string'],
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
            'skillsId' => 'Skills ID',
            'description' => 'Description',
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
