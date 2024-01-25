<?php

use backend\models\NgoTypes;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NgoDepartment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ngo-department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'ngoTypeId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NgoTypes::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Ngo Types'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Ngo Types') ?>

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