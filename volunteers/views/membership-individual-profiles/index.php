<?php

use frontend\models\MembershipIndividualProfiles;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipIndividualProfilesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Membership Individual Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-individual-profiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Membership Individual Profiles', ['create'], ['class' => 'btn btn-success']) ?>
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
            'firstname',
            //'otherNames',
            //'lastName',
            //'dateOfBirth',
            //'genderId',
            //'membershipUserId',
            //'countryId',
            //'passport',
            //'IdNo',
            //'membershipstatusId',
            //'membershipTypeId',
            //'ngoId',
            //'MembershipApprovalStatusId',
            //'effectiveDate',
            //'expiryDate',
            //'comments',
            //'createdTime',
            //'updatedTime',
            //'deleted',
            //'deletedTime',
            //'createdBy',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MembershipIndividualProfiles $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
