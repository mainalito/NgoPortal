<?php

use app\models\AdministrativeActions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Administrative Actions';
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
                <div class="administrative-actions-index">

                    <p>
                        <?= Html::a('Create Administrative Actions', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'actionName',
                            'requireAmount',
                            'requireText',
                            'canInitiateCase',
                            'createdTime',
                            [
                                'label' => 'Created By',
                                'attribute' => 'user.fullName',
                            ],
                            [
                                'class' => ActionColumn::className(),
                                'header' => 'Preview',
                                'template' => '{view}',
                                'urlCreator' => function ($action, AdministrativeActions $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'actionId' => $model->actionId]);
                                }
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</section>
