<?php

use backend\models\MembershipApprovalStatus;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Job Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$dataProvider = new ArrayDataProvider([
    'allModels' => [$model],
    'pagination' => false, // disable pagination
    'sort' => false, // disable sorting
]);

echo DetailView::widget([
    'dataProvider' => $dataProvider,
    'attributes' => [
        'name',
        'description',
        [
            'attribute' => 'timeCommitmentId',
            'value' => function ($model) {
                return $model->timeCommitment->name . ' - ' . $model->timeCommitment->numberOfHours . ' hours';
            },
        ],
        [
            'attribute' => 'requirements',
            'value' => function ($model) {
                return strip_tags($model->requirements);
            },
        ],
        'comments',
        'createdTime',
    ],
]);

?>
