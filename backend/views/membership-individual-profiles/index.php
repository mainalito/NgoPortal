<?php

use backend\models\MembershipIndividualProfiles;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Membership Individual Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-individual-profiles-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Membership Individual Profiles', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'firstname',
                'telephoneNo',
                'email:email',
                'physicalAddress',
            
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

        <?php Pjax::end(); ?>

    </div>
</div>