<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Communications $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Communications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="communications-view">
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
                    // 'id',
                    'title',
                    'description',
                    'attachments',
                
                    ['label'=>'Membership Type','value'=>function($model){
                        return $model->membershipType->name;
                    }],
                    ['label'=>'Communication Type','value'=>function($model){
                        return $model->communicationType->name;
                    }],
                
                    // 'comments',
                    'createdTime',
                    // 'updatedTime',
                    // 'deleted',
                    // 'deletedTime',
                    ['label'=>'Created By','value'=>function($model){
                        return $model->user->username;
                    }],
                    // 'createdBy',
                ],
            ]) ?>
        </div>


    </div>

</div>