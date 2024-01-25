<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SupportType $model */

$this->title = 'Create Support Type';
$this->params['breadcrumbs'][] = ['label' => 'Support Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-type-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>