<?php

use volunteers\models\Support;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Supports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Support', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                ['attribute'=>'description','value'=>function($model){
                    return strip_tags($model->description);
                }],
                // 'attachments',
                ['attribute'=>'resolution','value'=>function($model){
                    return strip_tags($model->resolution);
                }],
                ['attribute'=>'supportTypeId','value'=>function($model){
                    return $model->support->name;
                }],
                ['label'=>'Status','format'=>'raw','value'=>function($model){
                    return $model->resolution != '' ? Html::tag('span','Replied',['class'=>'badge badge-success']) :Html::tag('span','Not replied',['class'=>'badge badge-danger']);
                }],
                //'userId',
                //'comments',
                //'createdTime',
                //'updatedTime',
                //'deleted',
                //'deletedTime',
                //'createdBy',
                [
                    'class' => ActionColumn::className(),
                    'template'=>'{view}',
                    'urlCreator' => function ($action, Support $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</div>