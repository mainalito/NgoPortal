<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipIndividualProfiles $model */

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'Membership Individual Profiles', 'url' => ['site/profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">

                    <h4><?= Html::encode($this->title) ?></h4>
                </div>
                <div class="col-md-6 text-right">
                    <?= Html::a('<i class="fas fa-arrow-left mr-1"></i> Back', Yii::$app->urlManager->createUrl(['site/profile']), [
                        'class' => 'btn btn-danger uibutton loading confirm',
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="card-body">


            <?= $this->render('_form', [
                'model' => $model,
                'user' => $user
            ]) ?>
        </div>

    </div>
</div>
