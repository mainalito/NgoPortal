<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var common\models\Templates $model */
/** @var yii\widgets\ActiveForm $form */
?>

<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="form-section" style="margin-bottom: 0px"><?= $this->title; ?></h4>
                    <?= Html::a('Back', ['index'], ['class' => 'btn btn-danger btn-sm float-right']) ?>

                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <!-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li> -->
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                            <li><?=  Html::a('<i class="ft-x"></i>', ['index'], ['class' => '']) ?></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="templates-form">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-3">
                                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-9">
                                    <?= $form->field($model, 'templateName')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?= $form->field($model, 'message')->widget(CKEditor::className(), [
                                        'options' => ['rows' => 6],
                                        'preset' => 'full'
                                    ]) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success float-right btn-sm']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
