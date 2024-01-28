<?php

namespace volunteers\models;

use backend\models\Skills;
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
 *
 * @property Skills $skills
 * @property VolunteerProfile $volunteerProfile
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
            [['volunteerProfileId'], 'exist', 'skipOnError' => true, 'targetClass' => VolunteerProfile::class, 'targetAttribute' => ['volunteerProfileId' => 'id']],
            [['skillsId'], 'exist', 'skipOnError' => true, 'targetClass' => Skills::class, 'targetAttribute' => ['skillsId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skillsId' => 'Skill',
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

    /**
     * Gets query for [[Skills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasOne(Skills::class, ['id' => 'skillsId']);
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
