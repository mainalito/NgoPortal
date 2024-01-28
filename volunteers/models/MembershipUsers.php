<?php

namespace volunteers\models;

use Yii;

/**
 * This is the model class for table "membership_users".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $firstname
 * @property string|null $othernames
 * @property string|null $lastnames
 * @property string|null $email
 * @property int|null $membershipProfileId
 * @property string|null $password
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 *
 * @property MembershipIndividualProfiles $membershipProfile
 */
class MembershipUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membership_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'firstname', 'othernames', 'lastnames', 'email', 'password', 'comments'], 'string'],
            [['membershipProfileId', 'deleted', 'createdBy'], 'integer'],
            [['createdTime', 'createdBy'], 'required'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['membershipProfileId'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipIndividualProfiles::class, 'targetAttribute' => ['membershipProfileId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'firstname' => 'First Name',
            'othernames' => 'Other Name',
            'lastnames' => 'Last Name',
            'email' => 'Email',
            'membershipProfileId' => 'Membership Profile ID',
            'password' => 'Password',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[MembershipProfile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipProfile()
    {
        return $this->hasOne(MembershipIndividualProfiles::class, ['id' => 'membershipProfileId']);
    }
}
