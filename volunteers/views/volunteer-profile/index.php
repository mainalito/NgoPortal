<?php

use volunteers\models\VolunteerProfile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Volunteer Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Volunteer Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'telephoneNo',
            'email:email',
            'physicalAddress',
            'firstName',
            //'otherNames',
            //'lastNames',
            //'dateOfBirth',
            //'genderId',
            //'volunteerUserId',
            //'userId',
            //'countryId',
            //'passport',
            //'IdNo',
            //'availabilityId',
            //'comments',
            //'createdTime',
            //'updatedTime',
            //'deleted',
            //'deletedTime',
            //'createdBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VolunteerProfile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
