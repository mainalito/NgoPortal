<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TaskType $model */

$this->title = 'Create Task Type';
$this->params['breadcrumbs'][] = ['label' => 'Task Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-type-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>

    </div>


</div>