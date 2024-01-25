<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerEvents $model */

$this->title = 'Create Volunteer Events';
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-events-create">
    <div class="card">
        <h1 class="card-body"><?= Html::encode($this->title) ?></h1>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>