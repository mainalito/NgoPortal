<?php

namespace frontend\models;

use backend\models\Gender;
use backend\models\MembershipApprovalStatus;
use backend\models\MembershipStatus;
use backend\models\MembershipTypes;
use backend\models\NgoDepartment;
use common\models\User;
use Yii;

/**
 * This is the model class for table "membership_individual_profiles".
 *
 * @property int $id
 * @property string|null $telephoneNo
 * @property string|null $email
 * @property string|null $physicalAddress
 * @property string|null $firstname
 * @property string|null $otherNames
 * @property string|null $lastName
 * @property string|null $dateOfBirth
 * @property int|null $genderId
 * @property int|null $membershipUserId
 * @property int|null $userId
 * @property int|null $countryId
 * @property int|null $passport
 * @property int|null $IdNo
 * @property int|null $membershipstatusId
 * @property int|null $membershipTypeId
 * @property int|null $ngoId
 * @property int|null $MembershipApprovalStatusId
 * @property string|null $effectiveDate
 * @property string|null $expiryDate
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 *
 * @property Gender $gender
 * @property MembershipApprovalStatus $membershipApprovalStatus
 * @property MembershipTypes $membershipType
 * @property MembershipUsers[] $membershipUsers
 * @property MembershipStatus $membershipstatus
 * @property NgoDepartment $ngo
 * @property User $user
 */
class MembershipIndividualProfiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membership_individual_profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telephoneNo', 'email', 'physicalAddress', 'firstname', 'otherNames', 'lastName', 'comments'], 'string'],
            [['dateOfBirth', 'effectiveDate', 'expiryDate', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['genderId', 'membershipUserId', 'userId', 'countryId', 'passport', 'IdNo', 'membershipstatusId', 'membershipTypeId', 'ngoId', 'MembershipApprovalStatusId', 'deleted', 'createdBy'], 'integer'],
            [['createdTime', 'createdBy'], 'required'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
            [['genderId'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::class, 'targetAttribute' => ['genderId' => 'ID']],
            [['MembershipApprovalStatusId'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipApprovalStatus::class, 'targetAttribute' => ['MembershipApprovalStatusId' => 'id']],
            [['membershipstatusId'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipStatus::class, 'targetAttribute' => ['membershipstatusId' => 'id']],
            [['membershipTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipTypes::class, 'targetAttribute' => ['membershipTypeId' => 'id']],
            [['ngoId'], 'exist', 'skipOnError' => true, 'targetClass' => NgoDepartment::class, 'targetAttribute' => ['ngoId' => 'ID']],
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
            'firstname' => 'Firstname',
            'otherNames' => 'Other Names',
            'lastName' => 'Last Name',
            'dateOfBirth' => 'Date Of Birth',
            'genderId' => 'Gender ID',
            'membershipUserId' => 'Membership User',
            'userId' => 'User ID',
            'countryId' => 'Country ID',
            'passport' => 'Passport',
            'IdNo' => 'Id No',
            'membershipstatusId' => 'Membership Status ',
            'membershipTypeId' => 'Membership Type',
            'ngoId' => 'Ngo',
            'MembershipApprovalStatusId' => 'Membership Status',
            'effectiveDate' => 'Effective Date',
            'expiryDate' => 'Expiry Date',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
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
     * Gets query for [[MembershipApprovalStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipApprovalStatus()
    {
        return $this->hasOne(MembershipApprovalStatus::class, ['id' => 'MembershipApprovalStatusId']);
    }

    /**
     * Gets query for [[MembershipType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipType()
    {
        return $this->hasOne(MembershipTypes::class, ['id' => 'membershipTypeId']);
    }

    /**
     * Gets query for [[MembershipUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipUsers()
    {
        return $this->hasMany(MembershipUsers::class, ['membershipProfileId' => 'id']);
    }

    /**
     * Gets query for [[Membershipstatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipstatus()
    {
        return $this->hasOne(MembershipStatus::class, ['id' => 'membershipstatusId']);
    }

    /**
     * Gets query for [[Ngo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNgo()
    {
        return $this->hasOne(NgoDepartment::class, ['ID' => 'ngoId']);
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
