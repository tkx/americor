<?php
namespace app\services\HistoryItemFactory\contracts;
use app\models\History;
use app\services\HistoryItemFactory\contracts\HistoryItem;

/**
 * History DTO Factory 
 */
interface HistoryItemFactory {
    /** returns item filled with data */
    function createItem(History $model): HistoryItem;
}