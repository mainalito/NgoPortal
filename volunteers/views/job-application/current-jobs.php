<?php

use volunteers\models\JobListings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var volunteers\models\JobListingsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Current Jobs';
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
                    'jobListing.name',
                    'jobListing.description',
                    'jobListing.timeCommitment.name',
                    'jobListing.timeCommitment.numberOfHours',
                    'approvalStatus.name',
                    'jobListing.requirements',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('View', ['/volunteer-timesheet/create', 'jobId' => $model->jobListingId], ['class' => 'btn btn-sm btn-primary', 'style' => 'margin-right: 10px']);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>
