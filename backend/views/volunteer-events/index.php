<?php

use backend\models\VolunteerEvents;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Volunteer Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-events-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Volunteer Events', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'title',

                'eventDate',
                ['label' => 'Status', 'format' => 'raw', 'value' => function ($model) {
                    return $model->isPublished == 1 ? Html::tag('span', 'Published', ['class' => 'badge badge-success']) :
                        Html::tag('span', 'Unpublished', ['class' => 'badge badge-danger']);
                }],
                //'volunteerEventTypeId',
                //'comments',
                //'createdTime',
                //'updatedTime',
                //'deleted',
                //'deletedTime',
                //'createdBy',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, VolunteerEvents $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>