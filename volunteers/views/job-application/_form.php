<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var volunteers\models\JobApplication $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'createdBy')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
    <?= $form->field($model, 'volunteerProfileId')->hiddenInput(['value' => $profile->id])->label(false) ?>

    <?= $form->field($model, 'jobListingId')->hiddenInput(['value' => $job->id])->label(false) ?>

    <?= $form->field($model, 'approvalStatusId')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
