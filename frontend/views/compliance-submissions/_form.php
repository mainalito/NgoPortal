<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\ComplianceSubmissions $model */
/** @var yii\widgets\ActiveForm $form */
/** @var $years integer */
?>

<div class="compliance-submissions-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'year')->widget(Select2::classname(), [
                'data' => $years,
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => [
                    'placeholder' => 'Select year ...',
                    'autocomplete' => 'off'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col"></div>
    </div>
    <p>
        <b>Instructions:</b><br>
        1. Please complete the form below by entering one of C, D, or N in column 5 for each of the rows. Where a
        regulation has not been complied with, enter reason for non-compliance in column 6 of the respective row. You
        may use additional sheets if the explanation is lengthy and attach in documentation section.

    </p>

    <div class="form-group">
        <?= Html::submitButton('Save & Next', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
