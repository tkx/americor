<?php

namespace app\services\HistoryItemFactory\contracts;
use app\services\HistoryItemFactory\contracts\HistoryItem;

/**
 * History DTO creation method
 */
interface HistoryItemMethod {
    function __invoke(HistoryItem $item);
}