<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TimeCommitments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="time-commitments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['cols' => 5]) ?>

    <?= $form->field($model, 'numberOfHours')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'comments')->textarea(['cols' => 5]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
