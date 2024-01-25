<?php

use common\models\RegulationItems;
use common\models\SectionColumns;
use common\models\Sections;

/** @var yii\web\View $this */
/** @var RegulationItems $items */
/** @var SectionColumns $columns */
/** @var SectionColumns $require_columns */
/** @var app\models\ComplianceSubmissions $model */
/** @var app\models\ComplianceData $data */
/** @var Sections $sections */

$this->title = '';
\yii\web\YiiAsset::register($this);
?>
<table class="table table-striped table-bordered table-responsive text-wrap">
    <thead>
    <tr>
        <td style="background-color:#C6D9F1;">No.</td>
        <?php
        foreach ($columns as $column) { ?>
            <td style="background-color:#C6D9F1;"><?= $column->columnName ?></td>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $displayedRows = array();
    $count = 1;

    foreach ($items as $item) {
        $rowId = $item->regulation->regulationId;

        if (!in_array($rowId, $displayedRows)) {
            $displayedRows[] = $rowId;
            $rowspan = 0;

            foreach ($items as $innerRow) {
                if ($innerRow->regulation->regulationId === $rowId) {
                    $rowspan++;
                }
            }
            ?>
            <tr>
                <td style="background-color:#FDE9D9!important;"><?= $count++ ?></td>
                <td style="background-color:#FDE9D9!important;"
                    rowspan="<?= $rowspan ?>"><?= $item->regulation->regulationName ?></td>
                <td style="background-color:#FDE9D9!important;"><?= $item->reference ?></td>
                <td style="background-color:#FDE9D9!important;"><?= wordwrap($item->description, 77, '<br>') ?></td>
                <?php
                foreach ($require_columns as $require_column) { ?>
                    <?php if ($require_column->isStatus) : ?>
                        <td style="background-color:white!important;">
                            <select name="status[{'submissionId':<?= $model->submissionId ?>, 'row':<?= $item->itemId ?>, 'column':<?= $require_column->columnId ?>}]"
                                    class="form-control">
                                <option value="" selected disabled>Select--</option>
                                <option <?= (isset($data[$item->itemId][$require_column->columnId]['value']) && $data[$item->itemId][$require_column->columnId]['value'] == 'C') ? 'selected="selected"' : '' ?>
                                        value="C">Complied
                                </option>
                                <option <?= (isset($data[$item->itemId][$require_column->columnId]['value']) && $data[$item->itemId][$require_column->columnId]['value'] == 'D') ? 'selected="selected"' : '' ?>
                                        value="D">Did not Comply
                                </option>
                                <option <?= (isset($data[$item->itemId][$require_column->columnId]['value']) && $data[$item->itemId][$require_column->columnId]['value'] == 'N') ? 'selected="selected"' : '' ?>
                                        value="N">Not Applicable
                                </option>
                            </select>
                        </td>
                    <?php else : ?>
                        <td style="background-color:white!important;">
                                                    <textarea
                                                            name="description[{'submissionId':<?= $model->submissionId ?>, 'row':<?= $item->itemId ?>, 'column':<?= $require_column->columnId ?>}]"
                                                            class="form-control" rows="6"
                                                            cols="28"><?= $data[$item->itemId][$require_column->columnId]['value'] ?? '' ?></textarea>
                        </td>
                    <?php endif; ?>
                <?php } ?>
            </tr>
        <?php } else { ?>
            <tr>
                <td style="background-color:#FDE9D9!important;"><?= $count++ ?></td>
                <td style="background-color:#FDE9D9!important;"><?= $item->reference ?></td>
                <td style="background-color:#FDE9D9!important;"><?= wordwrap($item->description, 77, '<br>') ?></td>
                <?php
                foreach ($require_columns as $require_column) { ?>
                    <?php if ($require_column->isStatus) : ?>
                        <td style="background-color:white!important;">
                            <select name="status[{'submissionId':<?= $model->submissionId ?>, 'row':<?= $item->itemId ?>, 'column':<?= $require_column->columnId ?>}]"
                                    class="form-control">
                                <option value="" selected disabled>Select--</option>
                                <option <?= (isset($data[$item->itemId][$require_column->columnId]['value']) && $data[$item->itemId][$require_column->columnId]['value'] == 'C') ? 'selected="selected"' : '' ?>
                                        value="C">Complied
                                </option>
                                <option <?= (isset($data[$item->itemId][$require_column->columnId]['value']) && $data[$item->itemId][$require_column->columnId]['value'] == 'D') ? 'selected="selected"' : '' ?>
                                        value="D">Did not Comply
                                </option>
                                <option <?= (isset($data[$item->itemId][$require_column->columnId]['value']) && $data[$item->itemId][$require_column->columnId]['value'] == 'N') ? 'selected="selected"' : '' ?>
                                        value="N">Not Applicable
                                </option>
                            </select>
                        </td>
                    <?php else : ?>
                        <td style="background-color:white!important;">
                                                    <textarea
                                                            name="description[{'submissionId':<?= $model->submissionId ?>, 'row':<?= $item->itemId ?>, 'column':<?= $require_column->columnId ?>}]"
                                                            class="form-control" rows="6"
                                                            cols="28"><?= $data[$item->itemId][$require_column->columnId]['value'] ?? '' ?></textarea>
                        </td>
                    <?php endif; ?>
                <?php } ?>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
