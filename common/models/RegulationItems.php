<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "regulation_items".
 *
 * @property int $itemId
 * @property int $regulationId
 * @property int $sectionId
 * @property string|null $reference
 * @property string|null $description
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class RegulationItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regulation_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemId', 'regulationId', 'sectionId', 'createdTime', 'createdBy'], 'required'],
            [['itemId', 'regulationId', 'sectionId', 'deleted', 'createdBy'], 'integer'],
            [['comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['reference'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 3000],
            [['itemId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'itemId' => 'Item ID',
            'regulationId' => 'Regulation ID',
            'sectionId' => 'Section ID',
            'reference' => 'Reference',
            'description' => 'Description',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
    /**
     * Gets query for [[Regulations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegulation()
    {
        return $this->hasOne(Regulations::className(), ['regulationId' => 'regulationId']);
    }
}
