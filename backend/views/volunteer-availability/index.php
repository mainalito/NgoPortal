<?php

use backend\models\VolunteerAvailability;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Volunteer Availabilities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-availability-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Volunteer Availability', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'comments',
                'createdTime',
                'updatedTime',
                //'deleted',
                //'deletedTime',
                //'createdBy',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, VolunteerAvailability $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>