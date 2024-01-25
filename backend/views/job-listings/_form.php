<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\JobListings $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-listings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['cols' => 5]) ?>

    <?= $form->field($model, 'timeCommitmentId')->widget(\kartik\select2\Select2::classname(), [
        'data' => is_array($timeCommitments) ? \yii\helpers\ArrayHelper::map($timeCommitments, 'id', function($model) {
            return $model->name . ' - ' . $model->numberOfHours . ' hours';
        }) : [],
        'size' => \kartik\select2\Select2::SMALL,
        'options' => ['placeholder' => 'SELECT NUMBER OF HOURS REQUIRED', 'id' => 'month-dropdown'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>



    <?= $form->field($model, 'requirements')->textarea(['cols' => 5]) ?>

    <?= $form->field($model, 'comments')->textarea(['cols' => 5]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
