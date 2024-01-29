<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerSkills $model */

$this->title = 'Create Volunteer Skills';
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Skills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">

            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">


            <?= $this->render('_form', [
                'model' => $model,
                'volunteerProfile' => $volunteerProfile,
            ]) ?>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Skill</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (count($volunteerSkills) == 0) : ?>
                            <tr>
                                <td colspan="5" style="text-align: center; font-weight: bold;">
                                    ADD YOUR SKILLS
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php
                            $Count = 1;
                            foreach ($volunteerSkills as $ps): ?>
                                <tr>
                                    <td><?= $Count++ ?></td>
                                    <td>
                                        <?=  $ps->skills->name ?>
                                    </td>
                                    <td>
                                        <?=  $ps->description ?>
                                    </td>
<!--                                    <td>-->
<!--                                        --><?php //= \yii\helpers\Html::a('Edit', ['edit-substation', 'id' => $ps->ID], ['class' => 'btn btn-primary']) ?>
<!--                                        --><?php //= \yii\helpers\Html::a('Delete', ['delete-substation', 'id' => base64_encode($ps->ID)], ['class' => 'btn btn-danger', 'data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'post']) ?>
<!--                                    </td>-->
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
