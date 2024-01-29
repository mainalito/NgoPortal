<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerTimesheet $model */

$this->title = 'Update Volunteer Timesheet: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Timesheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volunteer-timesheet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
