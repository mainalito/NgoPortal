<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-volunteers',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'volunteers\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-volunteers',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'],
            'authTimeout'=>1800,
            'identityCookie' => ['name' => '_identity-volunteers', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the volunteers
            'name' => 'advanced-volunteers',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller>/<action>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
