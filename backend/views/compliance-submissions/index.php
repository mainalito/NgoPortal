<?php

use app\models\ComplianceSubmissions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Compliance Submissions';
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
                <div class="compliance-submissions-index">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'year',
                            [
                                'format' => ['date', 'php:d/m/Y h:i a'],
                                'attribute' => 'createdTime',
                                'label' => 'Creation Date ',
                            ],
                            [
                                'label' => 'Reported By',
                                'attribute' => 'user.organizationName',
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'header' => 'Preview',
                                'template' => '{view}',
                                'urlCreator' => function ($action, ComplianceSubmissions $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'submissionId' => $model->submissionId]);
                                }
                            ],
                        ],
                    ]); ?>


                </div>
            </div>
        </div>
    </div>
</section>