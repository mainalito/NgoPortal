<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var volunteers\models\MembershipUsers $model */

$this->title = 'Update Membership Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Membership Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="membership-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
