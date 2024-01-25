<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Inspections $model */
/** @var yii\widgets\ActiveForm $form */
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<div class="inspections-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col"><?= $form->field($model, 'inspectionTypeId')->dropDownList($inspection_types, ['prompt' => 'select inspection types']) ?></div>
        <div class="col"><?= $form->field($model, 'institutionTypeId')->dropDownList($institution_types, ['prompt' => 'select institution types']) ?></div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'inspectedInstitutionId')->widget(DepDrop::classname(), [
                'data' => [$model->inspectedInstitutionId => $model->institutionTypeId],
                'pluginOptions' => [
                    'depends' => ['inspections-institutiontypeid'],
                    'initialize' => !$model->isNewRecord,
                    'placeholder' => 'Select Financial Institution...',
                    'url' => Url::to(['/drop-downs/financial-institution'])
                ]
            ]); ?>
        </div>
        <div class="col"><?= $form->field($model, 'dateOfInspection')->textInput(['type' => 'date']) ?></div>
    </div>
    <div class="row">
        <div class="col"><?= $form->field($model, 'inspectionDescription')->textarea(['rows' => 6]) ?></div>
    </div>
    <div class="row">
        <div class="col"><?= $form->field($model, 'inspectionFindings')->textarea(['rows' => 6]) ?></div>
    </div>
    <div class="row">
        <div class="col"><?= $form->field($model, 'inspectionRecommendation')->textarea(['rows' => 6]) ?></div>
    </div>
    <div class="row">
        <div class="col"><?= $form->field($model, 'file')->fileInput() ?></div>
        <div class="col"><?= $form->field($model, 'actionId')->dropDownList($actions, ['prompt' => 'select administrative action']) ?></div>
    </div>
    <div class="row">
        <div class="col-6 has_amount"><?= $form->field($model, 'amount')->textInput() ?></div>
        <div class="col-6 has_text"><?= $form->field($model, 'actionDescription')->textarea() ?></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function getUnique() {
        $(document).on('change', '#inspections-actionid', function () {
            let id = $('#inspections-actionid').val();
            let commurl = '/inspections/require-unique';
            $.post(commurl, {
                'action_id': id,
                '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->getCsrfToken()?>'
            }, function (data) {
                if (data.length) {
                    Swal.fire("Error retrieving data", data, "error");
                    return false;
                }
                if (data.has_amount == 1) {
                    showAmount();
                }
                if (data.has_amount == 0) {
                    hideAmount();
                }
                if (data.has_text == 1) {
                    showText();
                }
                if (data.has_text == 0) {
                    hideText();
                }
            });
        });
    }

    function setUnique() {
        let id = $('#inspections-actionid').val();
        let commurl = '/inspections/require-unique';
        $.post(commurl, {
            'action_id': id,
            '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->getCsrfToken()?>'
        }, function (data) {
            if (data.length) {
                Swal.fire("Error retrieving data", data, "error");
                return false;
            }
            if (data.has_amount == 1) {
                showAmount();
            }
            if (data.has_amount == 0) {
                hideAmount();
            }
            if (data.has_text == 1) {
                showText();
            }
            if (data.has_text == 0) {
                hideText();
            }
        });
    }

    function showAmount() {
        $('.has_amount').show();
        $('#inspections-amount').prop('disabled', false);
    }

    function hideAmount() {
        $('.has_amount').hide();
        $('#inspections-amount').prop('disabled', true);
    }

    function showText() {
        $('.has_text').show();
        $('#inspections-actiondescription').prop('disabled', false);
    }

    function hideText() {
        $('.has_text').hide();
        $('#inspections-actiondescription').prop('disabled', true);
    }

    $(document).ready(function () {
        hideText();
        hideAmount();
        getUnique();
        setUnique();
    });
</script>