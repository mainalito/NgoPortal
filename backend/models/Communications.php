<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "communications".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $attachments
 * @property int|null $communicationTypeId
 * @property int|null $membershipTypeId
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class Communications extends \yii\db\ActiveRecord
{   
     /**
     * @var UploadedFile[]
     */
    public $documents;
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
        return 'communications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents'], 'file', 'skipOnEmpty' => true, 'extensions' => 'docx, pdf,xlsx'],
            
            [['title', 'description', 'attachments', 'comments'], 'string'],
            [['communicationTypeId', 'membershipTypeId', 'deleted', 'createdBy'], 'integer'],
            [['createdTime', 'createdBy','title','communicationTypeId','membershipTypeId'], 'required'],
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
            'title' => 'Title',
            'description' => 'Description',
            'attachments' => 'Attachments',
            'communicationTypeId' => 'Communication Type ID',
            'membershipTypeId' => 'Membership Type ID',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
    public function getMembershipType()
    {
        return $this->hasOne(MembershipTypes::className(), ['id' => 'membershipTypeId']);
    }
    public function getCommunicationType()
    {
        return $this->hasOne(CommunicationType::className(), ['id' => 'communicationTypeId']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
