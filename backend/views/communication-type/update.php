<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CommunicationType $model */

$this->title = 'Update Communication Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Communication Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="communication-type-update">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>

        <div class="card-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>


</div>