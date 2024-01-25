<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SupportType $model */

$this->title = 'Update Support Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Support Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'ID' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="support-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
