<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\JobApplication $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'volunteerProfileId')->textInput() ?>

    <?= $form->field($model, 'jobListingId')->textInput() ?>

    <?= $form->field($model, 'approvalStatusId')->textInput() ?>

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
