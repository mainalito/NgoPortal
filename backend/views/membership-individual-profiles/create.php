<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MembershipIndividualProfiles $model */

$this->title = 'Create Membership Individual Profile';
$this->params['breadcrumbs'][] = ['label' => 'Membership Individual Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-individual-profiles-create">
    <div class="card">
        <h5 class="card-header"><?= Html::encode($this->title) ?></h5>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>



</div>