<?php

use yii\helpers\Html;
use common\models\RegulationItems;
use common\models\SectionColumns;
use common\models\Sections;
use app\models\ComplianceSubmissions;
use app\models\ComplianceData;

/** @var yii\web\View $this */
/** @var RegulationItems $items */
/** @var SectionColumns $columns */
/** @var SectionColumns $require_columns */
/** @var Sections $sections */
/** @var ComplianceSubmissions $model */
/** @var ComplianceData $data */
/** @var $index integer */

$this->title = 'Annual Compliance';
?>
<section class="content" id="configuration ">
    <div class="card">
        <div class="card-header">
            <h4 class="form-section" style="margin-bottom: 0px"><?= $this->title; ?></h4>

            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <!-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li> -->
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                <span class="clearfix"></span>
                <div class="annual-compliance-create">

                    <?= $this->render('_compliance', [
                        'model' => $model,
                        'items' => $items,
                        'columns' => $columns,
                        'require_columns' => $require_columns,
                        'sections' => $sections,
                        'index' => $index,
                        'data' => $data
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</section>