<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/** @var yii\web\View $this */
/** @var app\models\CaseSources $model */

$this->title = 'Profile';
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
                <!-- content -->

                <div class="site-profile-view">

                    <?= DetailView::widget([
                        'model' => Yii::$app->user->identity,
                        'attributes' => [
                            'id',
                            'username',
                            'organizationName',
                            'email',
                            [
                                'format' => ['date', 'php:d/m/Y h:i a'],
                                'attribute' => 'createdTime',
                                'label' => 'Creation Date ',
                            ],
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</section>