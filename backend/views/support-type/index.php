<?php

use backend\models\SupportType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Support Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-type-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Support Type', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'ID',
                'name',
                'comments',
                'createdTime',
                'updatedTime',
                //'deleted',
                //'deletedTime',
                //'createdBy',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, SupportType $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'ID' => $model->ID]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>