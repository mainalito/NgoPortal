<?php

namespace backend\models;

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
 */
class VolunteerProfile extends \yii\db\ActiveRecord
{
    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'deleted', 0]);
    }

    /**
     * Added by Paul Mburu
     * To be executed before delete
     */
    public function delete()
    {
        $m = parent::findOne($this->getPrimaryKey());
        $m->deleted = 1;
        $m->deletedTime = date('Y-m-d H:i:s');
        return $m->save();
    }

    /**
     * Added by Paul Mburu
     * To be executed before Save
     */
   public function save($runValidation = true, $attributeNames = null)
    {
        //this record is always new
        if ($this->isNewRecord) {
            $this->createdBy = Yii::$app->user->identity->id;
            $this->deleted = 0;
            $this->createdTime = date('Y-m-d h:i:s');
        }
        return parent::save();
    }

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
            [['genderId', 'volunteerUserId', 'countryId', 'passport', 'IdNo', 'availabilityId', 'deleted', 'createdBy'], 'integer'],
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
            'firstName' => 'First Name',
            'otherNames' => 'Other Names',
            'lastNames' => 'Last Names',
            'dateOfBirth' => 'Date Of Birth',
            'genderId' => 'Gender ID',
            'volunteerUserId' => 'Volunteer User ID',
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
}
