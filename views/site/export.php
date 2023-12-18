<?php

/**
 * @var $this yii\web\View
 * @var $model \app\models\History
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $exportType string
 */

use app\widgets\Export\HistoryExport;

/**
 * Run HistoryExport in export mode: file download or scheduled export.
 * Configured with logic instances.
 */

echo HistoryExport::widget([
    "action" => $exportAction ?: HistoryExport::ACTION_DOWNLOAD,
    "dataProvider" => $dataProvider,
    "itemFactory" => $itemFactory,
    "download_params" => [
        "type" => $type,
        "chunk" => $chunk,
        'exportType' => $exportType,
    ]
]);
?>