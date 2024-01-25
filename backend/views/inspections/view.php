<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Inspections $model */

$this->title = $model->inspectionId;
YiiAsset::register($this);
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
                <p>
                    <?php if (Yii::$app->user->identity->id == $model->createdBy) : ?>
                        <?= Html::a('Update', ['update', 'inspectionId' => $model->inspectionId], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'inspectionId' => $model->inspectionId], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                    <?php if (!$model->used && $model->administrativeAction->can_create_case) : ?>
                        <?= Html::a('Create Case', ['/cases/create', 'inspectionId' => $model->inspectionId], [
                            'class' => 'btn btn-info',
                            'data' => [
                                'confirm' => 'Are you sure you want to create case for this inspection?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                    <?= Html::a('Close', ['index'], ['class' => 'btn btn-warning']) ?>
                </p>
                <div class="inspections-view">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'inspectionId',
                            [
                                'label' => 'Inspection Type',
                                'attribute' => 'inspectionType.inspectionTypeName',
                            ],
                            [
                                'label' => 'Inspected By',
                                'attribute' => 'institution.institutionName',
                            ],
                            [
                                'label' => 'Institution Type',
                                'attribute' => 'institutionType.institutionTypeName',
                            ],
                            [
                                'label' => 'Inspected Institution',
                                'attribute' => 'financialInstitution.financialInstitutionName',
                            ],
                            'dateOfInspection',
                            'inspectionDescription',
                            'inspectionFindings',
                            'inspectionRecommendation',
                            [
                                'attribute' => 'attachment', // Replace with the actual attribute name
                                'label' => 'Inspection Report', // Optional label
                                'format' => 'raw', // Set format to 'raw' to render HTML
                                'value' => function ($model) {
                                    // Generate the download link
                                    return Html::a('Download', ['download', 'inspectionId' => $model->inspectionId], ['class' => 'btn btn-primary']);
                                },
                            ],
                            'administrativeAction.actionName',
                            'amountOrText',
                            [
                                'format' => ['date', 'php:d/m/Y h:i a'],
                                'attribute' => 'createdTime',
                                'label' => 'Creation Date ',
                            ],
                            'updatedTime',
                            [
                                'label' => 'Created By',
                                'attribute' => 'user.fullName',
                            ],
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</section>
