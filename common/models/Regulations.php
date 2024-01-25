<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "regulations".
 *
 * @property int $regulationId
 * @property int $sectionId
 * @property string|null $regulationName
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class Regulations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regulations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sectionId', 'createdTime', 'createdBy'], 'required'],
            [['sectionId', 'deleted', 'createdBy'], 'integer'],
            [['comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['regulationName'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'regulationId' => 'Regulation ID',
            'sectionId' => 'Section ID',
            'regulationName' => 'Regulation Name',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
}
