<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

        <link rel="shortcut icon" href="../../dist/img/image001.png?v=1" type="image/x-icon" />
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>
    </head>
    <body class="hold-transition login-page">
    <?php $this->beginBody() ?>

    <main role="main">
        <?= $this->render('_alerts'); ?>
        <?= $content ?>
    </main>

    <?php $this->endBody() ?>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    </body>
    </html>
<?php $this->endPage();
