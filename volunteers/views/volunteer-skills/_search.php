<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerSkillsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="volunteer-skills-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'skillsId') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'volunteerProfileId') ?>

    <?= $form->field($model, 'comments') ?>

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
