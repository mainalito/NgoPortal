<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JobListings $model */

$this->title = 'Add Job';
$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">


            <?= $this->render('_form', [
                'model' => $model,
                'timeCommitments' => $timeCommitments
            ]) ?>
        </div>

    </div>
</div>
