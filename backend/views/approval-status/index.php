<?php

use backend\models\ApprovalStatus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Review Statuses';
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


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'comments',
                    'createdTime',
                    //'updatedTime',
                    //'deleted',
                    //'deletedTime',
                    //'createdBy',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, ApprovalStatus $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>

        </div>

    </div>

</div>
