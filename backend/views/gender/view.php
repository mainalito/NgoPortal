<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Gender $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Genders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">
<div class="card">
    <div class="card-header">

    <h4><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-body">



    <p>
        <?= Html::a('Update', ['update', 'ID' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'comments',
            'createdTime',
        ],
    ]) ?>
    </div>
</div>
</div>
