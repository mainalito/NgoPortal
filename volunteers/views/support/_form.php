<?php

use backend\models\SupportType;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var volunteers\models\Support $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="support-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'full'
            ]) ?>
        </div>
    </div>
   

    <?= $form->field($model, 'attachments')->textInput() ?>

    <!-- <?= $form->field($model, 'resolution')->textInput() ?> -->
    <?= $form->field($model, 'supportTypeId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(SupportType::find()->all(), 'ID', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Support Type'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Support Type') ?>



    <!-- <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'comments')->textInput() ?>

    <?= $form->field($model, 'createdTime')->textInput() ?>

    <?= $form->field($model, 'updatedTime')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deletedTime')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>