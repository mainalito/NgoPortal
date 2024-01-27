<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\MembershipIndividualProfiles $model */

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'Membership Individual Profiles', 'url' => ['index']];
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
                'user' => $user
            ]) ?>
        </div>

    </div>
</div>
