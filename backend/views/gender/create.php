<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Gender $model */

$this->title = 'Add Gender';
$this->params['breadcrumbs'][] = ['label' => 'Genders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

    <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>

    </div>

</div>
