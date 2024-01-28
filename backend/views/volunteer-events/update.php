<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerEvents $model */

$this->title = 'Update Volunteer Events: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volunteer-events-update">
    <div class="card">
        <h3 class="card-header"><?= Html::encode($this->title) ?></h3>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>