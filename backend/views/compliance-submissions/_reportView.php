<?php

use yii\helpers\Html;
use common\models\Sections;

/** @var yii\web\View $this */
/** @var app\models\ComplianceSubmissions $model */
/** @var Sections $sections */
/** @var $index integer */

$this->title = 'Annual compliance for : ' . $model->user->organizationName . ' for the year : ' . $model->year;
?>
<!--<div class="content-body">-->
<!--    <section class="content" id="basic-form-layouts">-->
<!--        <div class="card">-->
<!--            <div class="card-content collapse show">-->
<!--                <div class="card-body">-->
<!--                    <div class="compliance-submissions-create-summary">-->
                        <?php foreach ($sections as $section) { ?>
<!--                            <h3>--><?php //= $section->sectionName; ?><!--</h3>-->
                            <?= Yii::$app->runAction('compliance-submissions/data', ['submissionId' => $model->submissionId, 'sectionId' => $section->sectionId]); ?>
                        <?php } ?>

<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--</div>-->