<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Currency $model */

$this->title = 'Update Currency: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="currency-update">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>