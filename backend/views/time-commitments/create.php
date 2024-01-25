<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TimeCommitments $model */

$this->title = 'Add Time Commitments';
$this->params['breadcrumbs'][] = ['label' => 'Time Commitments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
