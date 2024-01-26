<?php

use common\models\Templates;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TemplatesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">
            <p>
                <?= Html::a('ADD', ['create'], ['class' => 'btn btn-success float-right']) ?>
            </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'templateName',
            'subject',
            'message:ntext',
            //'comments:ntext',
            //'createdTime',
            //'updatedTime',
            //'deleted',
            //'deletedTime',
            //'createdBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Templates $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'templateId' => $model->templateId]);
                 }
            ],
        ],
    ]); ?>

        </div>
    </div>

</div>
