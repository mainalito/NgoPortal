<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $countryId
 * @property string|null $countryName
 * @property string|null $comments
 * @property string|null $createdTime
 * @property string|null $updateTime
 * @property int|null $deleted
 * @property string|null $deletedTime
 * @property int|null $createdBy
 * @property int|null $usePassport
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comments'], 'string'],
            [['createdTime', 'updateTime', 'deletedTime'], 'safe'],
            [['deleted', 'createdBy', 'usePassport'], 'integer'],
            [['countryName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'countryId' => 'Country ID',
            'countryName' => 'Country Name',
            'comments' => 'Comments',
            'createdTime' => 'Created Time',
            'updateTime' => 'Update Time',
            'deleted' => 'Deleted',
            'deletedTime' => 'Deleted Time',
            'createdBy' => 'Created By',
            'usePassport' => 'Use Passport',
        ];
    }
}
