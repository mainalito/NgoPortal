<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerEventTypes $model */

$this->title = 'Create Volunteer Event Types';
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Event Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-event-types-create">
    <div class="card">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>