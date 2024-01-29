<?php

use volunteers\models\JobListings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var volunteers\models\JobListingsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Available Jobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'description',
                    [
                        'attribute' => 'timeCommitmentId',
                        'value' => function ($model) {
                            return ucwords($model->timeCommitment->name . ' - ' . $model->timeCommitment->numberOfHours . ' Hours');
                        },
                    ],
                    'requirements',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        'template' => '{apply}',
                        'buttons' => [
                            'apply' => function ($url, $model) {
                                return Html::a('Apply', ['/job-application/create', 'id' => base64_encode($model->id)], ['class' => 'btn btn-sm btn-primary', 'style' => 'margin-right: 10px']);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>
