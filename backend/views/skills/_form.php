<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Skills $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="skills-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'comments')->textarea(['cols' => 5]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
