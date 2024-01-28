<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ComplianceSubmissions $model */
/** @var $years years */

$this->title = 'Update Compliance Submissions: ' . $model->submissionId;
?>
<section class="content" id="configuration ">
    <div class="card">
        <div class="card-header">
            <h4 class="form-section" style="margin-bottom: 0px"><?= $this->title; ?></h4>

            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <!-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li> -->
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                <p class="float-right">
                    <?= Html::a('Close', ['index'], ['class' => 'btn btn-warning']) ?>
                </p>
                <span class="clearfix"></span>
                <div class="compliance-submissions-update">

                    <?= $this->render('_form', [
                        'model' => $model,
                        'years' => $years
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</section>