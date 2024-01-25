<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "institution_types".
 *
 * @property int $institutionTypeId
 * @property string|null $institutionTypeName
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updatedTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int $createdBy
 */
class InstitutionTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institution_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institutionTypeId', 'createdBy'], 'required'],
            [['institutionTypeId', 'deleted', 'createdBy'], 'integer'],
            [['comments'], 'string'],
            [['createdTime', 'updatedTime', 'deletedTime'], 'safe'],
            [['institutionTypeName'], 'string', 'max' => 100],
            [['institutionTypeId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'institutionTypeId' => 'Institution Type ID',
            'institutionTypeName' => 'Institution Type Name',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updatedTime' => 'Updated Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
        ];
    }
}
