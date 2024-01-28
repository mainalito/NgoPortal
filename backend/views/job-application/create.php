<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\JobApplication $model */

$this->title = 'Create Job Application';
$this->params['breadcrumbs'][] = ['label' => 'Job Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-application-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
