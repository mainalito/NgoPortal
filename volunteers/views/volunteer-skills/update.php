<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerSkills $model */

$this->title = 'Update Volunteer Skills: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Skills', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">


            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>

    </div>
</div>
