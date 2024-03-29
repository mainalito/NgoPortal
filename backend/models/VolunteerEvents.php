<?php

namespace backend\models;

use common\models\TaskTypeValidation;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "volunteer_events".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $attachments
 * @property string|null $eventDate
 * @property int|null $volunteerEventTypeId
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 * @property int $isPublished
 */
class VolunteerEvents extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $files;
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
        return 'volunteer_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, xls, xlsx, doc, docx'],
            [['title', 'description', 'attachments', 'comments'], 'string'],
            [['eventDate', 'createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['volunteerEventTypeId', 'deleted', 'createdBy','isPublished'], 'integer'],
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
            'title' => 'Title',
            'description' => 'Description',
            'attachments' => 'Attachments',
            'eventDate' => 'Event Date',
            'volunteerEventTypeId' => 'Volunteer Event Type',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
            'isPublished'=>'Published'
        ];
    }
    public function getEvent()
    {
        return $this->hasOne(VolunteerEventTypes::className(), ['id' => 'volunteerEventTypeId']);
    }
}
