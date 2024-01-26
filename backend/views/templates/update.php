<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Templates $model */

$this->title = 'Update Templates: ' . $model->templateId;
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->templateId, 'url' => ['view', 'templateId' => $model->templateId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="templates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
