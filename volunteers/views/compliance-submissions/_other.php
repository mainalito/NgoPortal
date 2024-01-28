<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Sections;

/** @var yii\web\View $this */
/** @var app\models\ComplianceSubmissions $model */
/** @var yii\widgets\ActiveForm $form */
/** @var Sections $sections */
/** @var index $index */
?>
<div class="content-body">
    <section class="content" id="basic-form-layouts">
        <div class="card" style="z-index:1">
            <div class="card-header">
                <?= $this->render('steps', ['sections' => $sections, 'index' => $index]); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header card--header">
                <h4>Compliance Details</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="compliance-submissions-form">

                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'file')->fileInput() ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= Html::a('Previous', ['compliance', 'submissionId' => $model->submissionId, 'sectionId' => $index - 2], ['class' => 'btn btn-warning']) ?>
                            <?= Html::submitButton('Save & Next', ['class' => 'btn btn-success']) ?>
                            <?= Html::a('Next', ['summary', 'submissionId' => $model->submissionId], ['class' => 'btn btn-info']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>