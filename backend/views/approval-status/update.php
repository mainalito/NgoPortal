<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ApprovalStatus $model */

$this->title = 'Update Review Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Approval Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">


            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
