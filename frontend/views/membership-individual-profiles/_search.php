<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipIndividualProfilesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-individual-profiles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'telephoneNo') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'physicalAddress') ?>

    <?= $form->field($model, 'firstname') ?>

    <?php // echo $form->field($model, 'otherNames') ?>

    <?php // echo $form->field($model, 'lastName') ?>

    <?php // echo $form->field($model, 'dateOfBirth') ?>

    <?php // echo $form->field($model, 'genderId') ?>

    <?php // echo $form->field($model, 'membershipUserId') ?>

    <?php // echo $form->field($model, 'countryId') ?>

    <?php // echo $form->field($model, 'passport') ?>

    <?php // echo $form->field($model, 'IdNo') ?>

    <?php // echo $form->field($model, 'membershipstatusId') ?>

    <?php // echo $form->field($model, 'membershipTypeId') ?>

    <?php // echo $form->field($model, 'ngoId') ?>

    <?php // echo $form->field($model, 'MembershipApprovalStatusId') ?>

    <?php // echo $form->field($model, 'effectiveDate') ?>

    <?php // echo $form->field($model, 'expiryDate') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'createdTime') ?>

    <?php // echo $form->field($model, 'updatedTime') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deletedTime') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
