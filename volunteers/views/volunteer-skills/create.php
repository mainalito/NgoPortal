<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var volunteers\models\VolunteerSkills $model */

$this->title = 'Create Volunteer Skills';
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Skills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-skills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
