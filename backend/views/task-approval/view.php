<?php

use backend\models\MembershipApprovalStatus;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\JobApplication $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Job Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="job-application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-header">
            Applied Job
        </div>
        <div class="card-body">
            <?php $this->render('_job_listing_view', ['model' => $model->job]) ?>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'volunteerProfileId',
                'value' => function ($model) {
                    return ucwords($model->volunteer->firstName . ' ' . $model->volunteer->otherNames . ' ' . $model->volunteer->lastNames);
                },
            ],

            'jobListingId',
            'approvalStatusId',
            'comments',
            'createdTime',
            'updatedTime',
            'deleted',
            'deletedTime',
            'createdBy',
        ],

    ]) ?>
    <div>
        <?= $form->field($model, 'approvalStatusId')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(MembershipApprovalStatus::find()->all(), 'id', 'name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select Status'],
            'pluginOptions' => [
                'allowClear' => true
            ],

        ])->label('Status') ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>