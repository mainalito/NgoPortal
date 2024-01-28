<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JobListings $model */

$this->title = 'Update Job Listings: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-listings-update">
    <div class="card">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model, 'timeCommitments' => $timeCommitments
            ]) ?>
        </div>
    </div>



</div>