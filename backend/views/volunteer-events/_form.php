<?php

use backend\models\VolunteerEvents;
use backend\models\VolunteerEventTypes;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerEvents $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="volunteer-events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'attachments')->fileInput() ?>

    <?= $form->field($model, 'eventDate')->input('date') ?>


    <?= $form->field($model, 'volunteerEventTypeId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(VolunteerEventTypes::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Volunteer Event Type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Volunteer Event Type') ?>

    <!-- <?= $form->field($model, 'volunteerEventTypeId')->textInput() ?> -->

    <?= $form->field($model, 'comments')->textInput() ?>
<!-- 
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
