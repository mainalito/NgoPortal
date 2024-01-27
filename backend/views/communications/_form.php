<?php

use backend\models\CommunicationType;
use backend\models\MembershipTypes;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Communications $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="communications-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


    <?= $form->field($model, 'title')->textInput() ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'full'
            ]) ?>
        </div>
    </div>
    <?= $form->field($model, 'attachments[]')->fileInput(['multiple' => true]) ?>


    <?= $form->field($model, 'communicationTypeId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(CommunicationType::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Communication Types'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Communication Types') ?>
    <?= $form->field($model, 'membershipTypeId')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(MembershipTypes::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Membership Types'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ])->label('Membership Types') ?>


    <!-- <?= $form->field($model, 'comments')->textInput() ?> -->

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