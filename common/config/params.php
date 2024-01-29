<?php
Yii::setAlias('@webfront',realpath(dirname(__FILE__).'/../../'));
return [
    'adminEmail' => 'rbssapplication@gmail.com',
    'supportEmail' => 'rbssapplication@gmail.com',
    'senderEmail' => 'rbssapplication@gmail.com',
    'senderName' => 'Annual Compliance',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'bsVersion' => '5.x',
    'ldPrefix' => 'FRC',
    'path_local' => \yii\helpers\Url::to('@webfront'),

];
