<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ApprovalStatus $model */

$this->title = 'Add Review Status';
$this->params['breadcrumbs'][] = ['label' => 'Review Statuses', 'url' => ['index']];
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
