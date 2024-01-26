<?php

use backend\models\Countries;
use backend\models\Gender;
use backend\models\MembershipStatus;
use backend\models\MembershipTypes;
use backend\models\NgoDepartment;
use backend\models\NgoTypes;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

/** @var yii\web\View $this */
/** @var backend\models\MembershipIndividualProfiles $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membership-individual-profiles-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'firstname')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'otherNames')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'lastName')->textInput() ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'telephoneNo')->widget(PhoneInput::className(), [
                'jsOptions' => [
                    'preferredCountries' => ['ke'],
                ]
            ]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->input('email') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'physicalAddress')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'dateOfBirth')->input('date') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'genderId')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Gender::find()->all(), 'ID', 'name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select Gender'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ])->label('Gender') ?>


        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'countryId')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Countries::find()->all(), 'countryId', 'countryName'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select Country', 'id' => 'membershipindividualprofiles-countryid'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Country') ?>


        </div>
    </div>
    <div class="row">

        <div class="col-md-4" id="passport" style="display: none;">
            <?= $form->field($model, 'passport')->textInput() ?>
        </div>
        <div class="col-md-4" id="idNo" style="display: none;">
            <?= $form->field($model, 'IdNo')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'membershipstatusId')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(MembershipStatus::find()->all(), 'id', 'name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select Membership Status'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]) ?>

        </div>
    </div>
    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'membershipTypeId')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(MembershipTypes::find()->all(), 'id', 'name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select Membership Types'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ngoId')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(NgoDepartment::find()->all(), 'id', 'name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select NGO'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'effectiveDate')->input('date') ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
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