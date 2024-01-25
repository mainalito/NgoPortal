<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\InspectionTypes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="inspection-types-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col"><?= $form->field($model, 'inspectionTypeName')->textInput(['maxlength' => true]) ?></div>
        <div class="col"></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
