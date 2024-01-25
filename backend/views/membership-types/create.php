<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MembershipTypes $model */

$this->title = 'Create Membership Types';
$this->params['breadcrumbs'][] = ['label' => 'Membership Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-types-create">
    <div class="card">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>