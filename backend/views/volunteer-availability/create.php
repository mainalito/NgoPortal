<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerAvailability $model */

$this->title = 'Create Volunteer Availability';
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Availabilities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-availability-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>