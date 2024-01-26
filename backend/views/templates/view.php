<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Templates $model */

$this->title = $model->templateId;
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="templates-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'templateId' => $model->templateId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'templateId' => $model->templateId], [
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
            'templateId',
            'code',
            'templateName',
            'subject',
            'message:ntext',
            'comments:ntext',
            'createdTime',
            'updatedTime',
            'deleted',
            'deletedTime',
            'createdBy',
        ],
    ]) ?>

</div>
