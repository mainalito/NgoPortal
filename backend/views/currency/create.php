<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Currency $model */

$this->title = 'Create Currency';
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-create">
    <div class="card">
        <h1 class="card-header"><?= Html::encode($this->title) ?></h1>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>

    </div>


</div>