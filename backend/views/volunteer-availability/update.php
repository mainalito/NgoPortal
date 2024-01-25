<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerAvailability $model */

$this->title = 'Update Volunteer Availability: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Availabilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volunteer-availability-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
