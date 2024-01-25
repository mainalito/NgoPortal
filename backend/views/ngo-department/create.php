<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\NgoDepartment $model */

$this->title = 'Create Ngo Department';
$this->params['breadcrumbs'][] = ['label' => 'Ngo Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ngo-department-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>