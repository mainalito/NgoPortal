<?php

use backend\models\JobListings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\JobListingsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Job Listings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

            <h4><?= Html::encode($this->title) ?></h4>

        </div>
        <div class="card-body">

            <p>
                <?= Html::a('Add', ['create'], ['class' => 'btn btn-success float-right']) ?>
            </p>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'description',
                    [
                        'attribute' => 'timeCommitmentId',
                        'value' => function ($model) {
                            return $model->timeCommitment->name . ' - ' . $model->timeCommitment->numberOfHours . ' hours';
                        },
                    ],
                    'requirements',
                    'comments',
                    'createdTime',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, JobListings $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>

    </div>

</div>
