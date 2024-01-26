<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipIndividualProfiles $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-individual-profiles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'telephoneNo')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'physicalAddress')->textInput() ?>

    <?= $form->field($model, 'firstname')->textInput() ?>

    <?= $form->field($model, 'otherNames')->textInput() ?>

    <?= $form->field($model, 'lastName')->textInput() ?>

    <?= $form->field($model, 'dateOfBirth')->textInput() ?>

    <?= $form->field($model, 'genderId')->textInput() ?>

    <?= $form->field($model, 'membershipUserId')->textInput() ?>

    <?= $form->field($model, 'countryId')->textInput() ?>

    <?= $form->field($model, 'passport')->textInput() ?>

    <?= $form->field($model, 'IdNo')->textInput() ?>

    <?= $form->field($model, 'membershipstatusId')->textInput() ?>

    <?= $form->field($model, 'membershipTypeId')->textInput() ?>

    <?= $form->field($model, 'ngoId')->textInput() ?>

    <?= $form->field($model, 'MembershipApprovalStatusId')->textInput() ?>

    <?= $form->field($model, 'effectiveDate')->textInput() ?>

    <?= $form->field($model, 'expiryDate')->textInput() ?>

    <?= $form->field($model, 'comments')->textInput() ?>

    <?= $form->field($model, 'createdTime')->textInput() ?>

    <?= $form->field($model, 'updatedTime')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deletedTime')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
