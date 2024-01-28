<?php

/** @var yii\web\View $this */

use volunteers\models\MembersUpdateForm;

/** @var yii\bootstrap5\ActiveForm $form */

/** @var MembersUpdateForm $model */


use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="site-login">
        <div class="mt-5 col">
            <p class="login-box-msg">Please fill out the following fields to update and login:</p>
            <div class="row">
                <div class="col">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>
            
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
