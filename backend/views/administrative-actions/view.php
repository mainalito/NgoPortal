<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\AdministrativeActions $model */

$this->title = $model->actionName;
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
                <div class="administrative-actions-view">

                    <p class="float-right">
                        <?= Html::a('Update', ['update', 'actionId' => $model->actionId], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'actionId' => $model->actionId], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?= Html::a('Close', ['index'], ['class' => 'btn btn-warning']) ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'actionId',
                            'actionName',
                            'requireAmount',
                            'requireText',
                            'canInitiateCase',
                            'createdTime',
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
