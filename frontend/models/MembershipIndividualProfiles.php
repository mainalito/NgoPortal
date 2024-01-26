<?php

namespace frontend\models;

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
 * @property MembershipUsers[] $membershipUsers
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
            [['genderId', 'membershipUserId', 'countryId', 'passport', 'IdNo', 'membershipstatusId', 'membershipTypeId', 'ngoId', 'MembershipApprovalStatusId', 'deleted', 'createdBy'], 'integer'],
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
            'telephoneNo' => 'Telephone No',
            'email' => 'Email',
            'physicalAddress' => 'Physical Address',
            'firstname' => 'Firstname',
            'otherNames' => 'Other Names',
            'lastName' => 'Last Name',
            'dateOfBirth' => 'Date Of Birth',
            'genderId' => 'Gender ID',
            'membershipUserId' => 'Membership User ID',
            'countryId' => 'Country ID',
            'passport' => 'Passport',
            'IdNo' => 'Id No',
            'membershipstatusId' => 'Membershipstatus ID',
            'membershipTypeId' => 'Membership Type ID',
            'ngoId' => 'Ngo ID',
            'MembershipApprovalStatusId' => 'Membership Approval Status ID',
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
     * Gets query for [[MembershipUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipUsers()
    {
        return $this->hasMany(MembershipUsers::class, ['membershipProfileId' => 'id']);
    }
}
