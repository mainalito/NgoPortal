<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MembershipIndividualProfiles $model */

$this->title = 'Update Membership Individual Profiles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Membership Individual Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="membership-individual-profiles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
