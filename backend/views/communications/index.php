<?php

use backend\models\Communications;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Communications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="communications-index">
<div class="container">
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create Communications', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        'description',
        'attachments',
        'communicationTypeId',
        //'membershipTypeId',
        //'comments',
        //'createdTime',
        //'updatedTime',
        //'deleted',
        //'deletedTime',
        //'createdBy',
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Communications $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
             }
        ],
    ],
]); ?>

<?php Pjax::end(); ?>

</div>  
</div>
  
