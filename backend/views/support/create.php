<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\support $model */

$this->title = 'Create Support';
$this->params['breadcrumbs'][] = ['label' => 'Supports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>