<?php

use backend\models\SupportType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\support $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="support-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'attachments')->textInput() ?>

    <?= $form->field($model, 'resolution')->textInput() ?>

    <!-- <?= $form->field($model, 'supportTypeId')->textInput() ?> -->
    <?= $form->field($model, 'supportTypeId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(SupportType::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Support Types'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Support Types') ?>

    <!-- <?= $form->field($model, 'userId')->textInput() ?> -->

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
