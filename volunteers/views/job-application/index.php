<?php

use volunteers\models\JobApplication;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var volunteers\models\JobApplicationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Job Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-application-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Job Application', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'volunteerProfileId',
            'jobListingId',
            'approvalStatusId',
            'comments',
            //'createdTime',
            //'updatedTime',
            //'deleted',
            //'deletedTime',
            //'createdBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JobApplication $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
