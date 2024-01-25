<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MembershipStatus $model */

$this->title = 'Update Membership Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Membership Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="membership-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
