<?php

use backend\models\Currency;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\MembershipTypes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'associatedBenefits')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>
    <?= $form->field($model, 'currencyId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Currency::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Currency'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Currency') ?>
    <!-- <?= $form->field($model, 'currencyId')->textInput() ?> -->

    <?= $form->field($model, 'comments')->textInput() ?>

    <!-- <?= $form->field($model, 'createdTime')->textInput() ?>

    <?= $form->field($model, 'updatedTime')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deletedTime')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
