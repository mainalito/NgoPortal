<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "inspections".
 *
 * @property int $inspectionId
 * @property int|null $inspectionTypeId
 * @property int|null $institutionTypeId
 * @property int|null $inspectedInstitutionId
 * @property string|null $dateOfInspection
 * @property string|null $inspectionDescription
 * @property string|null $inspectionFindings
 * @property string|null $inspectionRecommendation
 * @property int|null $actionId
 * @property float|null $amount
 * @property string|null $actionDescription
 * @property int|null $institutionId
 * @property resource|null $attachment
 * @property int|null $used
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class Inspections extends ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inspections';
    }

    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'inspections.deleted', 0]);
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
            $this->institutionId = Yii::$app->user->identity->institutionId;
            $this->createdTime = date('Y-m-d h:i:s');
        }
        return parent::save();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inspectionTypeId', 'institutionTypeId', 'inspectedInstitutionId', 'actionId', 'institutionId', 'used', 'deleted', 'createdBy'], 'integer'],
            [['dateOfInspection', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['inspectionDescription', 'inspectionFindings', 'inspectionRecommendation', 'attachment', 'comments'], 'string'],
            [['file'], 'file', 'extensions' => ['pdf'], 'maxSize' => 1024 * 1024 * 2], // Max size is 2 MB
            [['amount'], 'number'],
            [['createdBy'], 'required'],
            [['actionDescription'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inspectionId' => 'Inspection ID',
            'inspectionTypeId' => 'Inspection Type',
            'institutionTypeId' => 'Institution Type',
            'inspectedInstitutionId' => 'Inspected Institution',
            'dateOfInspection' => 'Date Of Inspection',
            'inspectionDescription' => 'Inspection Description',
            'inspectionFindings' => 'Inspection Findings',
            'inspectionRecommendation' => 'Inspection Recommendation',
            'actionId' => 'Administrative Action',
            'amount' => 'Amount',
            'actionDescription' => 'Action Description',
            'institutionId' => 'Institution',
            'attachment' => 'Inspection Report',
            'file' => 'Inspection Report',
            'used' => 'Utilized',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[AdministrativeActions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrativeAction()
    {
        return $this->hasOne(AdministrativeActions::className(), ['actionId' => 'actionId']);
    }
    public function getAmountOrText()
    {
        if ($this->administrativeAction->hasAmount)
            return $this->amount;
        return $this->actionDescription;
    }

    /**
     * Gets query for [[InspectionTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInspectionType()
    {
        return $this->hasOne(InspectionTypes::className(), ['inspectionTypeId' => 'inspectionTypeId']);
    }

    /**
     * Gets query for [[FinancialInstitutionType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutionType()
    {
        return $this->hasOne(InstitutionType::className(), ['institutionTypeId' => 'institutionTypeId']);
    }

    /**
     * Gets query for [[FinancialInstitutions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialInstitution()
    {
        return $this->hasOne(FinancialInstitutions::className(), ['financialInstitutionId' => 'inspectedInstitutionId']);
    }

    /**
     * Gets query for [[Institutions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitution()
    {
        return $this->hasOne(Institutions::className(), ['institutionId' => 'institutionId']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
