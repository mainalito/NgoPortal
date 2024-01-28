<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipIndividualProfiles $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-individual-profiles-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'userId')->hiddenInput(['value' => $user->id])->label(false) ?>
    <?= $form->field($model, 'createdBy')->hiddenInput(['value' => $user->id])->label(false) ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'firstname')->textInput(['value' => $user->firstname, 'readonly'=> true]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'otherNames')->textInput(['value' => $user->othernames, 'readonly'=> true]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'lastName')->textInput(['value' => $user->lastnames, 'readonly'=> true]) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'telephoneNo')->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                'jsOptions' => [
                    'preferredCountries' => ['ke'],
                ]
            ]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['value' => $user->email, 'readonly'=> true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'physicalAddress')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'dateOfBirth')->input('date', ['max' => date('Y-m-d'), 'value' => $model->dateOfBirth ? date('Y-m-d', strtotime($model->dateOfBirth)) : null]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'genderId')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Gender::find()->all(), 'ID', 'name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select Gender'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ])->label('Gender') ?>


        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'countryId')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Countries::find()->all(), 'countryId', 'countryName'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select Country', 'id' => 'membershipindividualprofiles-countryid'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Country') ?>


        </div>
    </div>
    <div class="row">

        <div class="col-md-6" id="passport" style="display: none;">
            <?= $form->field($model, 'passport')->textInput() ?>
        </div>
        <div class="col-md-6" id="idNo" style="display: none;">
            <?= $form->field($model, 'IdNo')->textInput() ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'membershipTypeId')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\MembershipTypes::find()->all(), 'id', 'name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select Membership Types'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ngoId')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\NgoDepartment::find()->all(), 'ID', 'name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select NGO'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]) ?>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#membershipindividualprofiles-countryid").change(function() {
            const countryId = $(this).val();

            // Perform AJAX request to get country information
            $.ajax({
                url: '/membership-individual-profiles/get-country-info',
                type: 'GET',
                data: {
                    countryId: countryId
                },
                dataType: 'json',
                success: function(response) {
                    // Update form fields based on the response
                    if (response.usePassport === 0) {
                        $("#idNo").show();
                        $("#membershipindividualprofiles-idNo").prop("disabled", false).prop("required", true);
                        $("#membershipindividualprofiles-passport").prop("disabled", true).prop("required", false);
                        $("#passport").hide();
                    } else {
                        $("#idNo").hide();
                        $("#membershipindividualprofiles-idNo").prop("disabled", true).prop("required", false);
                        $("#membershipindividualprofiles-passport").prop("disabled", false).prop("required", true);
                        $("#passport").show();
                    }

                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
