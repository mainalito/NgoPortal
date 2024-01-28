<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var volunteers\models\MembershipUsers $model */

$this->title = 'Register';
$this->params['breadcrumbs'][] = ['label' => 'Membership Users', 'url' => ['index']];
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
            ]) ?>
        </div>

    </div>
</div>
