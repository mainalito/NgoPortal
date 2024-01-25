<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MembershipApprovalStatus $model */

$this->title = 'Update Membership Approval Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Membership Approval Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="membership-approval-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
