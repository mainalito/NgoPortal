<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "compliance_submissions".
 *
 * @property int $submissionId
 * @property int $year
 * @property string|null $attachments
 * @property string|null $doc_extension
 * @property int|null $submitted
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class ComplianceSubmissions extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compliance_submissions';
    }

    /**
     * Added by Paul Mburu
     * Filter Deleted Items
     */
    public static function find()
    {
        return parent::find()->andWhere(['=', 'compliance_submissions.deleted', 0]);
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
    public function rules()
    {
        return [
            [['year', 'createdTime', 'createdBy'], 'required'],
            [['year', 'deleted', 'createdBy', 'submitted'], 'integer'],
            [['doc_extension'], 'string'],
            [['comments', 'attachments'], 'string'],
            [['file'], 'file', 'extensions' => ['pdf'], 'maxSize' => 1024 * 1024 * 2], // Max size is 2 MB
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            ['year','unique', 'targetAttribute' => ['year', 'createdBy'], 'message' => 'You have already created a record for this year. Consider updating if you have not submitted'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'submissionId' => 'Submission ID',
            'year' => 'Reporting Year',
            'comments' => 'Comments',
            'attachments' => 'Non Compliance Supporting document',
            'file' => 'Non Compliance Supporting document',
            'doc_extension' => 'Document Extension',
            'submitted' => 'Submitted',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
