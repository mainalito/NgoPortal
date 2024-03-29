<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MembershipApprovalStatus $model */

$this->title = 'Create Membership Approval Status';
$this->params['breadcrumbs'][] = ['label' => 'Membership Approval Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-approval-status-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>