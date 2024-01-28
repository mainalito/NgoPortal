<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerSkills $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="volunteer-skills-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'createdBy')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
    <?= $form->field($model, 'volunteerProfileId')->hiddenInput(['value' => $volunteerProfile->id])->label(false) ?>
    <?= $form->field($model, 'skillsId')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Skills::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Skill'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
