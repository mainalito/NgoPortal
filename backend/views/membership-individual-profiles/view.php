<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\MembershipIndividualProfiles $model */

$this->title = $model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Membership Individual Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="membership-individual-profiles-view">
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
                    ['label' => 'Full Names', 'value' => function ($model) {
                        return ucwords($model->firstname . ' ' . $model->otherNames . ' ' . $model->lastName);
                    }],
                    // 'id',
                    'telephoneNo',
                    'email:email',
                    'physicalAddress',
                 
                    // 'firstname',
                    // 'otherNames',
                    // 'lastName',
                    'dateOfBirth',
                    ['label' => 'Gender', 'value' => function ($model) {
                        return ($model->gender->name);
                    }],
                 
                    // 'membershipUserId',
                    ['label' => 'Country', 'value' => function ($model) {
                        return ($model->country->countryName);
                    }],
                    
                    'passport',
                    'IdNo',
                    ['label' => 'Membership Status', 'value' => function ($model) {
                        return ($model->membershipStatus->name);
                    }],
                   
                    ['label' => 'Membership Type', 'value' => function ($model) {
                        return ($model->membershipType->name);
                    }],
                    ['label' => 'NGO', 'value' => function ($model) {
                        return ($model->ngo->name);
                    }],
                    ['label' => 'Membership Approval Status', 'value' => function ($model) {
                        return (@$model->membershipApprovalStatus->name);
                    }],
                
                
                    // 'MembershipApprovalStatusId',
                    'effectiveDate',
                    'expiryDate',
                    // 'comments',
                    'createdTime',
                    // 'updatedTime',
                    // 'deleted',
                    // 'deletedTime',
                    ['label' => 'Created By', 'value' => function ($model) {
                        return (@$model->user->username);
                    }],
                    // 'createdBy',
                ],
            ]) ?>

        </div>
    </div>
</div>