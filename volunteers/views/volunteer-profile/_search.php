<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerProfileSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="volunteer-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'telephoneNo') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'physicalAddress') ?>

    <?= $form->field($model, 'firstName') ?>

    <?php // echo $form->field($model, 'otherNames') ?>

    <?php // echo $form->field($model, 'lastNames') ?>

    <?php // echo $form->field($model, 'dateOfBirth') ?>

    <?php // echo $form->field($model, 'genderId') ?>

    <?php // echo $form->field($model, 'volunteerUserId') ?>

    <?php // echo $form->field($model, 'userId') ?>

    <?php // echo $form->field($model, 'countryId') ?>

    <?php // echo $form->field($model, 'passport') ?>

    <?php // echo $form->field($model, 'IdNo') ?>

    <?php // echo $form->field($model, 'availabilityId') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'createdTime') ?>

    <?php // echo $form->field($model, 'updatedTime') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deletedTime') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
