<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MembershipTypes $model */

$this->title = 'Update Membership Types: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Membership Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="membership-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
