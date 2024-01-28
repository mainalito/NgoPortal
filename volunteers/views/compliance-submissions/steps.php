<?php

use common\models\Sections;

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$currentRoute = Yii::$app->controller->module->requestedRoute;

/** @var Sections $sections */
/** @var $index */
?>
<style>
    * {
        box-sizing: border-box;
    }

    .horizontal-progressbar {
        text-align: center;
        width: 100%;
        /* zoom: 3;
        transform: scale(0.8); */
    }

    .counter div {
        background-color: white;
        display: inline-block;
        border: 1px solid grey;
        border-radius: 50%;
        width: 2em;
        line-height: 1.88em;
        vertical-align: top;
    }

    .counter td {
        cursor: pointer;
        text-align: center;
        position: relative;
    }

    .counter span {
        position: absolute;
        top: 1em;
        left: -50%;
        width: 100%;
        border-top: 2px solid grey;
        z-index: -100;
    }

    /* list of numbers to be displayed */
    .progress-item {
        counter-increment: list;
    }

    .progress-item.next-step div::after {
        content: counter(list);
    }

    .progress-item.current-step div::after {
        content: counter(list);
    }

    /* completed step will have a ✔ instead of a number */
    .progress-item.completed-step div::after {
        content: '✔';
    }

    /* green color for completed and current step, gray for incomplete steps */
    .progress-item.current-step * {
        border-color: #37bd46 !important;
        color: #37bd46 !important;
    }

    .progress-item.completed-step * {
        border-color: #37bd46 !important;
        color: #37bd46 !important;
    }

    .progress-item.next-step * {
        border-color: grey !important;
        color: grey !important;
    }

    .descriptions .current-step {
        color: #37bd46 !important;
    }

    .descriptions .completed-step {
        color: #37bd46 !important;
    }

    .descriptions .next-step {
        color: grey !important;
    }

    .descriptions td {
        width: 190px; /* adjust this value for text-wrapping*/
    }

    .descriptions td {
        width: 190px; /* adjust this value for text-wrapping*/
    }
</style>
<!-- responsive -->
<table class="horizontal-progressbar">
    <tr class="counter">
        <td class="progress-item <?= ($controller == 'compliance-submissions' && ($action == 'create' || $action == 'update') ) ? 'current-step' : ''; ?> <?= ($index > 1) ? 'completed-step' : 'next-step'; ?>">
            <div></div>
        </td>
        <?php foreach ($sections as $section) : ?>
            <td class="progress-item <?= ($controller == 'compliance-submissions' && ($action == 'compliance' || $action == 'update-compliance')  && $index == ($section->sectionId + 1)) ? 'current-step' : 'next-step'; ?> <?= ($index > ($section->sectionId + 1)) ? 'completed-step' : 'next-step'; ?>">
                <div></div>
                <span></span>
            </td>
        <?php endforeach; ?>
        <td class="progress-item <?= ($controller == 'compliance-submissions' && ($action == 'other-details')) ? 'current-step' : 'next-step'; ?> <?= ($index > 5) ? 'completed-step' : 'next-step'; ?>">
            <div></div>
            <span></span>
        </td>
        <td class="progress-item <?= ($currentRoute == 'compliance-submissions/5') ? 'current-step' : 'next-step'; ?>">
            <div></div>
            <span></span>
        </td>
    </tr>
    <!-- descriptions below the counters -->
    <tr class="descriptions">
        <td class="<?= ($controller == 'cases' && ($action == 'create' || $action == 'update')) ? 'current-step' : 'next-step'; ?>">
            Introduction
        </td>
        <?php foreach ($sections as $section) : ?>
            <td class="progress-item <?= ($controller == 'compliance-submissions' && ($action == 'compliance' || $action == 'update-compliance') && $index == ($section->sectionId + 1)) ? 'current-step' : 'next-step'; ?> <?= ($index > ($section->sectionId + 1)) ? 'completed-step' : 'next-step'; ?>">
                <?= $section->sectionName?>
            </td>
        <?php endforeach; ?>
        <td class="<?= ($controller == 'cases' && ($action == 'other-details')) ? 'current-step' : 'next-step'; ?>">
            Documentation
        </td>
        <td class="<?= ($currentRoute == 'cases/5') ? 'current-step' : 'next-step'; ?>">Summary</td>
    </tr>
</table>
