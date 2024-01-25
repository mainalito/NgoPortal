<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "compliance_matrix".
 *
 * @property int $matrixId
 * @property int $columnId
 * @property int $itemId
 * @property string|null $comments
 * @property string $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class ComplianceMatrix extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compliance_matrix';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matrixId', 'columnId', 'itemId', 'createdBy'], 'required'],
            [['matrixId', 'columnId', 'itemId', 'deleted', 'createdBy'], 'integer'],
            [['comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['matrixId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'matrixId' => 'Matrix ID',
            'columnId' => 'Column ID',
            'itemId' => 'Item ID',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
}
