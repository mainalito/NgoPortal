<?php

namespace volunteers\models;

use backend\models\Countries;
use backend\models\Gender;
use backend\models\VolunteerAvailability;
use common\models\User;
use Yii;

/**
 * This is the model class for table "volunteer_profile".
 *
 * @property int $id
 * @property string|null $telephoneNo
 * @property string|null $email
 * @property string|null $physicalAddress
 * @property string|null $firstName
 * @property string|null $otherNames
 * @property string|null $lastNames
 * @property string|null $dateOfBirth
 * @property int|null $genderId
 * @property int|null $volunteerUserId
 * @property int|null $userId
 * @property int|null $countryId
 * @property int|null $passport
 * @property int|null $IdNo
 * @property int|null $availabilityId
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 *
 * @property VolunteerAvailability $availability
 * @property Countries $country
 * @property Gender $gender
 * @property User $user
 */
class VolunteerProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'volunteer_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telephoneNo', 'email', 'physicalAddress', 'firstName', 'otherNames', 'lastNames', 'comments'], 'string'],
            [['dateOfBirth', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['genderId', 'volunteerUserId', 'userId', 'countryId', 'passport', 'IdNo', 'availabilityId', 'deleted', 'createdBy'], 'integer'],
            [['createdTime', 'createdBy'], 'required'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::class, 'targetAttribute' => ['countryId' => 'ID']],
            [['genderId'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::class, 'targetAttribute' => ['genderId' => 'ID']],
            [['availabilityId'], 'exist', 'skipOnError' => true, 'targetClass' => VolunteerAvailability::class, 'targetAttribute' => ['availabilityId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telephoneNo' => 'Telephone No',
            'email' => 'Email',
            'physicalAddress' => 'Physical Address',
            'firstName' => 'First Name',
            'otherNames' => 'Other Names',
            'lastNames' => 'Last Names',
            'dateOfBirth' => 'Date Of Birth',
            'genderId' => 'Gender ID',
            'volunteerUserId' => 'Volunteer User ID',
            'userId' => 'User ID',
            'countryId' => 'Country ID',
            'passport' => 'Passport',
            'IdNo' => 'Id No',
            'availabilityId' => 'Availability ID',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Availability]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvailability()
    {
        return $this->hasOne(VolunteerAvailability::class, ['id' => 'availabilityId']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['ID' => 'countryId']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::class, ['ID' => 'genderId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
