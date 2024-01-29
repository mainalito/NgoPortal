<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerTimesheet $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="volunteer-timesheet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'starttime')->textInput(['type' => 'time']) ?>
    <?= $form->field($model, 'endtime')->textInput(['type' => 'time']) ?>


    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->

    <!-- <?= $form->field($model, 'volunteerProfileId')->textInput() ?> -->


    <!-- <?= $form->field($model, 'comments')->textInput() ?>

    <?= $form->field($model, 'createdTime')->textInput() ?>

    <?= $form->field($model, 'updatedTime')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deletedTime')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>