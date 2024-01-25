<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Gender $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gender-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!--    --><?php //= $form->field($model, 'isApproval')->textInput() ?>

    <?= $form->field($model, 'comments')->textarea(['cols' => 5]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
