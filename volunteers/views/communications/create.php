<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Communications $model */

$this->title = 'Create Communications';
$this->params['breadcrumbs'][] = ['label' => 'Communications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="communications-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>