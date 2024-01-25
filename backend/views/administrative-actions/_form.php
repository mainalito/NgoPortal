<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AdministrativeActions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="administrative-actions-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col"><?= $form->field($model, 'actionName')->textInput(['maxlength' => true]) ?></div>
        <div class="col"><?= $form->field($model, 'hasAmount')->checkbox() ?></div>
    </div>
    <div class="row">
        <div class="col"><?= $form->field($model, 'hasText')->checkbox() ?></div>
        <div class="col"><?= $form->field($model, 'can_create_case')->checkbox() ?></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function hasAmount() {
        $(document).on("click", "#administrativeactions-hasamount", function () {
            let isChecked = document.getElementById('administrativeactions-hasamount').checked;
            if (isChecked) {
                document.getElementById('administrativeactions-hastext').disabled = true;
                document.getElementById('administrativeactions-hastext').checked = false;
            } else {
                document.getElementById('administrativeactions-hastext').disabled = false;
            }
        });
    }

    function hasText() {
        $(document).on("click", "#administrativeactions-hastext", function () {
            let isChecked = document.getElementById('administrativeactions-hastext').checked;
            if (isChecked) {
                document.getElementById('administrativeactions-hasamount').disabled = true;
                document.getElementById('administrativeactions-hasamount').checked = false;
            } else {
                document.getElementById('administrativeactions-hasamount').disabled = false;
            }
        });
    }

    function setAmount() {
        let isChecked = document.getElementById('administrativeactions-hasamount').checked;
        if (isChecked) {
            document.getElementById('administrativeactions-hastext').disabled = true;
            document.getElementById('administrativeactions-hastext').checked = false;
        } else {
            document.getElementById('administrativeactions-hastext').disabled = false;
        }
    }

    function setText() {
        let isChecked = document.getElementById('administrativeactions-hastext').checked;
        if (isChecked) {
            document.getElementById('administrativeactions-hasamount').disabled = true;
            document.getElementById('administrativeactions-hasamount').checked = false;
        } else {
            document.getElementById('administrativeactions-hasamount').disabled = false;
        }
    }

    $(document).ready(function () {
        hasAmount();
        hasText();
        setAmount();
        setText();
    });
</script>
