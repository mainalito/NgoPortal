<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipIndividualProfiles $model */

$this->title = 'Create Membership Individual Profiles';
$this->params['breadcrumbs'][] = ['label' => 'Membership Individual Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membership-individual-profiles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
