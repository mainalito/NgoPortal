<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TaskType $model */

$this->title = 'Update Task Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Task Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>