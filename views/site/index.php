<?php

use app\widgets\HistoryList\HistoryList;
use app\widgets\Export\HistoryExport;

$this->title = 'Americor Test';

/**
 * HistoryList covers history output.
 * HistoryExport covers history export.
 */
?>

<div class="site-index">
    <?= HistoryExport::widget([
        "action" => HistoryExport::ACTION_FORM, 
        "chunk_size" => $export_chunk_size,
        "fullDataProvider" => $export_fullDataProvider,
    ]) ?>
    <?= HistoryList::widget([
        'dataProvider' => $list_dataProvider,
        'itemFactory' => $list_itemFactory,
    ]) ?>
</div>
