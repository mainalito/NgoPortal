<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\support $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Supports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="support-view">
    <div class="container">
        <div class="card">
            <h3 class="card-header"><?= Html::encode($this->title) ?></h3>

            <div class="card-body">



                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        ['attribute' => 'description', 'value' => function ($model) {
                            return strip_tags($model->description);
                        }],
                        ['attribute' => 'resolution', 'value' => function ($model) {
                            return strip_tags($model->resolution);
                        }],
                        'attachments',
                        // 'resolution',
                        ['attribute' => 'supportTypeId', 'value' => function ($model) {
                            return $model->support->name;
                        }],

                        'comments',
                        'createdTime',
                        // 'updatedTime',
                        // 'deleted',
                        // 'deletedTime',
                        ['label' => 'Sent By', 'value' => function ($model) {
                            return $model->user->username;
                        }],
                    ],
                ]) ?>

            </div>
            <?php $form = ActiveForm::begin(); ?>
          
                <div class="row">
                    <div class="col">
                        <?= $form->field($model, 'resolution')->widget(CKEditor::className(), [
                            'options' => ['rows' => 6],
                            'preset' => 'full'
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>



</div>