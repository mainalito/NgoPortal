<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var volunteers\models\Support $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Supports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
<div class="card">
<h3 class="card-header"><?= Html::encode($this->title) ?></h3>

    <div class="card-body">



<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        ['attribute'=>'description','value'=>function($model){
            return strip_tags($model->description);
        }],
        ['attribute' => 'resolution', 'value' => function ($model) {
            return strip_tags($model->resolution);
        }],
        'attachments',
       
        ['attribute'=>'supportTypeId','value'=>function($model){
            return $model->support->name;
        }],
        
        // 'userId',
         'comments',
        'createdTime',
        // 'updatedTime',
        // 'deleted',
        // 'deletedTime',
        //  'createdBy',
    ],
]) ?>
    </div>
</div>
    

</div>
