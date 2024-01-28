<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var LoginForm $model */

use common\models\LoginForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="site-login">
        <div class="mt-5 col">
            <p class="login-box-msg">Please fill out the following fields to login:</p>
            <div class="row">
                <div class="col">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="my-1 mx-0" style="color:#999;">
                        If you have no account you
                        can <?= Html::a('Create account', ['site/signup']) ?>.
                        <br>
                        If you forgot your password you
                        can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                        <br>
                        Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
