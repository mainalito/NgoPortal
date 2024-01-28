<?php

use kartik\dialog\Dialog;

echo Dialog::widget();
?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <i class="icon fa fa-times"></i> <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('warning')): ?>
    <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <i class="icon fa fa-times"></i> <?= Yii::$app->session->getFlash('warning') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <i class="icon fa fa-check"></i> <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>