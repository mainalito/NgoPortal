<?php

use backend\models\NgoDepartment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ngo Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngo-department-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Ngo Department', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'ID',
                'name',
                'description',
                'ngoTypeId',
                'comments',
                //'createdTime',
                //'updatedTime',
                //'deleted',
                //'deletedTime',
                //'createdBy',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, NgoDepartment $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'ID' => $model->ID]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>