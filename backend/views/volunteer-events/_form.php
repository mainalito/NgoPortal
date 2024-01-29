<?php

use backend\models\VolunteerEventTypes;

use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerEvents $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="volunteer-events-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'files[]')->fileInput(['multiple' => true]) ?>

    <?= $form->field($model, 'eventDate')->widget(DatePicker::class, [
        'options' => ['class' => 'form-control'],
        'dateFormat' => 'yyyy-MM-dd', // specify the format here
        'clientOptions' => [
            'changeYear' => true,
            'changeMonth' => true,
            'minDate' => 0,

        ],
    ]) ?>

    <?= $form->field($model, 'volunteerEventTypeId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(VolunteerEventTypes::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Volunteer Event Type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'isPublished')->radioList([1 => 'Yes', 2 => 'No'])->hint('If you select this, your event will be published to the volunteers') ?>



    <!-- <?= $form->field($model, 'comments')->textInput() ?> -->

    <!-- <?= $form->field($model, 'createdTime')->textInput() ?>

    <?= $form->field($model, 'updatedTime')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deletedTime')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>