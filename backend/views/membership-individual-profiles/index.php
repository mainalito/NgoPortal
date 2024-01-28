<?php

use backend\models\MembershipIndividualProfiles;
use backend\models\MembershipStatus;
use backend\models\MembershipTypes;
use kartik\export\ExportMenu;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Membership Individual Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-individual-profiles-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'fullName')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'membershipstatusId')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(MembershipStatus::find()->all(), 'id', 'name'),
                            'language' => 'en',
                            'options' => ['placeholder' => 'Select Membership Status'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],

                        ])->label('Membership status') ?></div>
                    <div class="col-md-4">
                        <?= $form->field($searchModel, 'membershipTypeId')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(MembershipTypes::find()->all(), 'id', 'name'),
                            'language' => 'en',
                            'options' => ['placeholder' => 'Select Membership Types'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],

                        ])->label('Membership Type') ?>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                
            </div>

            <?php ActiveForm::end(); ?>
        </div>


        <p>
            <?= Html::a('Create Membership Individual Profiles', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                ['label' => 'Full Names', 'value' => function ($model) {
                    return ucwords($model->firstname . ' ' . $model->otherNames . ' ' . $model->lastName);
                }],
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
                ['label' => 'Membership Status', 'value' => function ($model) {
                    return ($model->membershipStatus->name);
                }],

                ['label' => 'Membership Type', 'value' => function ($model) {
                    return ($model->membershipType->name);
                }],
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
              
            ],
        ]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                ['label' => 'Full Names', 'value' => function ($model) {
                    return ucwords($model->firstname . ' ' . $model->otherNames . ' ' . $model->lastName);
                }],
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
                ['label' => 'Membership Status', 'value' => function ($model) {
                    return ($model->membershipStatus->name);
                }],

                ['label' => 'Membership Type', 'value' => function ($model) {
                    return ($model->membershipType->name);
                }],
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