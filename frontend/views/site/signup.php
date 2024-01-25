<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var SignupForm $model */
/** @var InstitutionTypes $institution_types */

use app\models\InstitutionTypes;
use frontend\models\SignupForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="login-box" style="min-height: 600px; max-height: 800px;">-->
<!--    <div class="site-signup">-->
<section class="content">
    <div class="container-fluid">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signup:</p>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'email') ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'organizationTypeId')->dropdownList($institution_types,
                    ['prompt'=>'select organization type'])->label('Organization Type') ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'organizationName')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'contactPerson')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?= $form->field($model, 'goamlId')->textInput(['maxlength' => true])->label('GoAML ID') ?>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
            </div>
        </div>
        <div class="my-1 mx-0" style="color:#999;">
            If you have an account you
            can <?= Html::a('login', ['site/login']) ?>.
        </div>


        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>