<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NgoDepartment $model */

$this->title = 'Update Ngo Department: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ngo Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ngo-department-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
