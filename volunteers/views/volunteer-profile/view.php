<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerProfile $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="volunteer-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'telephoneNo',
            'email:email',
            'physicalAddress',
            'firstName',
            'otherNames',
            'lastNames',
            'dateOfBirth',
            'genderId',
            'volunteerUserId',
            'userId',
            'countryId',
            'passport',
            'IdNo',
            'availabilityId',
            'comments',
            'createdTime',
            'updatedTime',
            'deleted',
            'deletedTime',
            'createdBy',
        ],
    ]) ?>

</div>
