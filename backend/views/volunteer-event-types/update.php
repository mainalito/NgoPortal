<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerEventTypes $model */

$this->title = 'Update Volunteer Event Types: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Event Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volunteer-event-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
