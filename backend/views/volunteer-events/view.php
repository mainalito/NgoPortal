<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\VolunteerEvents $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="card">
        <h3 class="card-header"><?= Html::encode($this->title) ?></h3>


        <div class="card-body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
                    'id',
                    'title',
                    ['attribute'=>'description','value'=>function ($model){
                        return strip_tags( $model->description);
                    }],
                
                    'attachments',
                    'eventDate',
                    ['attribute'=>'volunteerEventTypeId','value'=>function ($model){
                        return strip_tags( $model->event->name);
                    }],
                
                    'comments',
                    'createdTime',
                    // 'updatedTime',
                    // 'deleted',
                    // 'deletedTime',
                    // 'createdBy',
                ],
            ]) ?>
        </div>
    </div>




</div>