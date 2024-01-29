<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    'title',
                    ['attribute' => 'description', 'value' => function ($model) {
                        return strip_tags($model->description);
                    }],

                    'attachments',
                    'eventDate',
                    ['attribute' => 'volunteerEventTypeId', 'value' => function ($model) {
                        return strip_tags($model->event->name);
                    }],

                    // 'comments',
                    // 'createdTime',
                    // 'updatedTime',
                    // 'deleted',
                    // 'deletedTime',
                    // 'createdBy',
                ],
            ]) ?>
            <?php $form = ActiveForm::begin(); ?>
            <?php
            $readOnly = !is_null($eventParticipant->isConfirmed);

            if ($readOnly) {
                // Display a label or message indicating that the event is confirmed
                echo $form->field($eventParticipant, 'isConfirmed')->label('Event Confirmed')->textInput(['disabled' => true,'value'=>$eventParticipant->isConfirmed == 1 ?'Yes':'No']);
            } else {
                // Allow the user to confirm the event using the checkbox list
                echo $form->field($eventParticipant, 'isConfirmed')->checkboxList([(int)1 => 'Yes']);
            }
            ?>

            <?php if (is_null($eventParticipant->isConfirmed)) : ?>
                <div class="form-group">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-success']) ?>
                </div>
            <?php endif; ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>