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


        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                ['label' => 'Membership Type', 'value' => function ($model) {
                    return $model->membershipType->name;
                }],
                ['label' => 'Communication Type', 'value' => function ($model) {
                    return $model->communicationType->name;
                }],
                [
                    'class' => ActionColumn::className(),
                    'template' => '{view}', // Only show the view action
                    'urlCreator' => function ($action, Communications $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>


        <?php Pjax::end(); ?>

    </div>
</div>