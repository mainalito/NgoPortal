<?php

/** @var View $this */

/** @var string $content */

use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;


$baseUrl = Yii::$app->request->baseUrl;
$user = Yii::$app->user->identity;
$currentPage = Yii::$app->controller->id;
$currentRoute = Yii::$app->controller->module->requestedRoute;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge"><!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?= Url::to('@web/plugins/fontawesome-free/css/all.min.css') ?>">
        <!-- IonIcons -->
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?= Url::to('@web/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= Url::to('@web/dist/css/adminlte.min.css') ?>">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- jQuery -->
        <script src="<?= Url::to('@web/plugins/jquery/jquery_new.min.js') ?>"></script>
        <link rel="shortcut icon" href="../../dist/img/image001.png?v=1" type="image/x-icon" />
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <style>
        .required:before {
            content: " *";
            color: red;
        }

        .help-block {
            color: #BF1B00 !important;
        }
    </style>
    <body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light"">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a class="nav-link" href="/site/profile"><i class="fa fa-user"></i>My Profile</a>
                    <div class="dropdown-divider"></div>
                    <?php
                    echo Html::beginForm(['/site/logout'], 'post');
                    echo Html::submitButton(
                        '<i class="fa fa-power-off"></i> Logout',
                        ['class' => 'btn btn-link logout nav-link']
                    );
                    echo Html::endForm(); ?>
                </div>
            </li>
        </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-green elevation-4"  style="background-color: green; color: white!important;">
            <!-- Brand Logo -->
            <a href="/" class="brand-link  mt-3 pb-3 mb-3 d-flex" style="padding: 0!important;">
                <img src="../../dist/img/logo.png"
                     alt="Logo"
                     class="brand-image"
                     style="opacity: 1!important; max-height: 50px!important; margin: 0!important; width: 245px!important;">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="/" class="d-block"><b><?= Yii::$app->user->identity->organizationName ?></b></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= ($currentPage == 'site') ? 'active' : ''; ?>">
                                    <a href="/site" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-gavel"></i>
                                <p>Compliance <i class="right fas fa-angle-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= ($currentPage == 'compliance-submissions') ? 'active' : ''; ?>">
                                    <a href="/compliance-submissions" class="nav-link"><i class="fas fa-upload nav-icon"></i>
                                        <p>Annual Compliance</p></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tape"></i>
                                <p>
                                    Inspections
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= ($currentPage == 'inspections') ? 'active' : ''; ?>">
                                    <a href="/inspections" class="nav-link"><i class="fas fa-folder nav-icon"></i>
                                        <p>Inspections</p></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>Application Setup<i class="right fas fa-angle-right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item <?= ($currentPage == 'communication-types') ? 'active' : ''; ?>">
                                    <a href="/communication-types" class="nav-link"><i
                                                class="fa fa-tags nav-icon"></i>
                                        <p>Communication Types</p></a>
                                </li>
                                <li class="nav-item <?= ($currentPage == 'administrative-actions') ? 'active' : ''; ?>">
                                    <a href="/administrative-actions" class="nav-link"><i
                                                class="fa fa-tags nav-icon"></i>
                                        <p>Administrative Actions</p></a>
                                </li>
                                <li class="nav-item <?= ($currentPage == 'inspection-types') ? 'active' : ''; ?>">
                                    <a href="/inspection-types" class="nav-link"><i
                                                class="fa fa-check-circle nav-icon"></i>
                                        <p>Inspection Type</p></a>
                                </li>
                                <li class="nav-item <?= ($currentPage == 'institutions-type') ? 'active' : ''; ?>">
                                    <a href="/institution-type" class="nav-link"><i
                                                class="fas fa-wallet nav-icon"></i>
                                        <p>Institution Type</p></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <?= \yii\widgets\Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'options' => ['class' => 'breadcrumb text-right'],
                                'itemTemplate' => '<li>{link}</li>',
                                'activeItemTemplate' => '<li class="active">{link}</li>',
                            ]) ?>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="clearfix"></div>
            <?= $this->render('_alerts'); ?>
            <?= $content ?>
        </div>
        <!-- /.content-wrapper -->
        <div class="clearfix"></div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Powered By</b> E-tech Enterprise Solutions
            </div>
        </footer>
    </div>
    <!--<script>-->
    <!--    $(document).ready(function() {-->
    <!--        var url = window.location;-->
    <!--        var element = $('ul.sidebar-menu a').filter(function() {-->
    <!--            return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');-->
    <!--        if (element.is('li')) {-->
    <!--            element.addClass('active').parent().parent('li').addClass('active')-->
    <!--        }-->
    <!--    });-->
    <!--</script>-->
    <script>
        $(document).ready(function () {
            /*** add active class and stay opened when selected ***/
            var url = window.location;

            // for sidebar menu entirely but not cover treeview
            $('ul.nav-sidebar a').filter(function () {
                if (this.href) {
                    return this.href == url || url.href.indexOf(this.href) == 0;
                }
            }).addClass('active');

            // for the treeview
            $('ul.nav-treeview a').filter(function () {
                if (this.href) {
                    return this.href == url || url.href.indexOf(this.href) == 0;
                }
            }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
        });
    </script>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap -->
    <script src="<?= Url::to('@web/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= Url::to('@web/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <!-- AdminLTE -->
    <script src="<?= Url::to('@web/dist/js/adminlte.js') ?>"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="<?= Url::to('@web/plugins/chart.js/Chart.min.js') ?>"></script>
    <script src="<?= Url::to('@web/dist/js/demo.js') ?>"></script>
    <script src="<?= Url::to('@web/dist/js/pages/dashboard3.js') ?>"></script>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
