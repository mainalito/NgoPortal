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

    <?= $form->field($model, 'coverLetter')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>
    <?= $form->field($model, 'cv')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'uploadUrl' => \yii\helpers\Url::to(['uploads/jobApplication']),
            'showUpload' => false,
            'maxFileSize' => 30240,
            'showRemove' => true,
            'enableResumableUpload' => true,
            'initialPreviewAsData' => true,
            'showCancel' => true,
            'theme' => 'fa5',
        ],
    ]); ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
