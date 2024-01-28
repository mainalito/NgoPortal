<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var volunteers\models\JobListings $model */

$this->title = 'Create Job Listings';
$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-listings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
