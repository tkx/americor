<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use app\services\HistoryItemFactory\HistoryListItem;

/**
 * @inheritDoc
 */
class CommonItemMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        
        /** @var HistoryListItem $item */
        $item->setView("_item_common");
    }
}