<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Sections;

/** @var yii\web\View $this */
/** @var app\models\ComplianceSubmissions $model */
/** @var Sections $sections */
/** @var $index */

$this->title = 'Annual Compliance for Year: ' . $model->year;
\yii\web\YiiAsset::register($this);
?>
<div class="content-body">
    <section class="content" id="basic-form-layouts">
        <div class="card" style="z-index:1">
            <div class="card-header">
                <?= $this->render('steps', ['sections' => $sections, 'index' => $index]); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header card--header">
                <h4><?= $this->title ?></h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <p class="float-right">
                        <?= $model->submitted != 1 ? Html::a('Previous', ['documentation', 'submissionId' => $model->submissionId], ['class' => 'btn btn-info']) : '' ?>
                        <?= Html::a('Close', ['index'], ['class' => 'btn btn-primary mr-1']) ?>
                        <?= $model->submitted != 1 ? Html::a('Submit', ['submit', 'submissionId' => $model->submissionId], [
                            'class' => 'btn btn-danger mr-1',
                            'data' => [
                                'confirm' => 'Are you sure you want to Submit this item?',
                                'method' => 'post',
                            ],
                        ]) : ''?>
                    </p>
                    <span class="clearfix"></span>
                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                        <li class="nav-item">
                            <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                               href="#tab1"
                               aria-expanded="true">Details</a>
                        </li>
                        <?php foreach ($sections as $section) { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3"
                                   aria-expanded="false"
                                   onclick="loadpage('<?= Yii::$app->urlManager->createUrl('compliance-submissions/data?submissionId=' . $model->submissionId . '&sectionId=' . $section->sectionId); ?>', 'tab3')"><?= $section->sectionName; ?></a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4"
                               aria-expanded="true">Supporting Documentation</a>
                        </li>
                    </ul>

                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true"
                             aria-labelledby="base-tab1">
                            <h4 class="form-section"></h4>
                            <?= DetailView::widget([
                                'model' => $model,
                                'options' => [
                                    'class' => 'table-striped table-bordered zero-configuration',
                                    'style' => 'width: 100%'
                                ],
                                'attributes' => [
                                    'submissionId',
                                    'year',
                                    'complianceRate',
                                    [
                                        'attribute' => 'createdTime',
                                        'format' => ['date', 'php:d/m/Y h:i a'],
                                    ],
                                    [
                                        'attribute' => 'user.organizationName',
                                        'label' => 'Reported By'
                                    ]
                                ],
                            ]) ?>
                        </div>

                        <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
                            <h4 class="form-section"></h4>
                        </div>

                        <div class="tab-pane" id="tab4" aria-labelledby="base-tab4">
                            <h4 class="form-section"></h4>
                            <?php if (!is_null($model->attachments)) : ?>
                                <iframe src="data:application/pdf;base64,<?php echo base64_encode($model->attachments) ?>"
                                        type="application/pdf" width="100%" height="300px"
                                        oncontextmenu="return false;"></iframe>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var xmlHttp4
    var xmlHttp3
    var Op;

    function GetXmlHttpObject() {
        var xmlHttp = null;
        try {
            // Firefox, Opera 8.0+, Safari
            xmlHttp = new XMLHttpRequest();
        } catch (e) {
            //Internet Explorer
            try {
                xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlHttp;
    }

    function loadpage(url, destination, loader) {
        // $('table').DataTable();
        dest = destination;
        currentPage = document.getElementById(destination).innerHTML;
        Loader = loader;
        xmlHttp4 = GetXmlHttpObject()
        if (xmlHttp4 == null) {
            alert("Browser does not support HTTP Request")
            return
        }
        if (document.getElementById(destination))
            document.getElementById(destination).innerHTML = 'loading....'
        //document.getElementById(loader).innerHTML= '<img src="images/ajax-loader.gif" width="16" height="16" />'
        url = url + "&sid=" + Math.random()
        xmlHttp4.onreadystatechange = contentpage
        xmlHttp4.open("GET", url, true)
        xmlHttp4.send(null)
    }

    function contentpage() {
        // console.log(xmlHttp4);
        if (xmlHttp4.readyState == 4 || xmlHttp4.readyState == "complete") {

            if (document.getElementById(Loader)) {
                document.getElementById(dest).innerHTML = ""
            }
            if (xmlHttp4.status == 405) {
                console.log('Do Nothing');
                document.getElementById(dest).innerHTML = currentPage;
            } else {
                document.getElementById(dest).innerHTML = xmlHttp4.responseText;
            }

            // $('table').DataTable();
            //
            // $(".select2").select2();

        }
    }

    function submitForm(url, destination, formName, btn) {
        // Disable Button
        var bt = document.getElementById(btn);
        if (bt) {
            var onclick = bt.getAttribute('onclick');
            bt.setAttribute('onclick', '');
        }

        var form = document.getElementById(formName);
        // Create a new FormData object.
        var formData = new FormData(form);

        // Set up the request.
        var xhr = new XMLHttpRequest();
        // Open the connection.
        xhr.open('POST', url, true);
        // Set up a handler for when the request finishes.
        xhr.onload = function () {
            if (xhr.status === 200) {
                // File(s) uploaded.
                // rest = xhr.responseText;
                document.getElementById(destination).innerHTML = xhr.responseText
                // alert(rest);
                // loadtab(url,destination,element,'Saved Successfully');
            } else {
                document.getElementById('msg').innerHTML = 'Failed to save Record';
                bt.setAttribute('onclick', onclick);
            }
        };
        // Send the Data.
        xhr.send(formData);
    }

    function deleteItem(url, destination, loader) {
        msg = "Are you sure you wish to delete this record";
        var a = confirm(msg);
        if (!a) {
            return false;
        }

        loadpage(url, destination, loader);
    }
</script>
