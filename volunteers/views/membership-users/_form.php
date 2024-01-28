<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipUsers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">

            <?= $form->field($model, 'firstname')->textInput() ?>
        </div>
        <div class="col-md-4">

            <?= $form->field($model, 'othernames')->textInput() ?>
        </div>
        <div class="col-md-4">

            <?= $form->field($model, 'lastnames')->textInput() ?>
        </div>

    </div>
    <?= $form->field($model, 'email')->textInput() ?>


    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'username')->textInput() ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

    </div>

    <hr>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
