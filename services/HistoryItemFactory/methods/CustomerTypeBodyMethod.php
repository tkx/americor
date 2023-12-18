<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use app\services\HistoryItemFactory\HistoryListItem;
use app\models\Customer;

/**
 * @inheritDoc
 */
class CustomerTypeBodyMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        
        /** @var HistoryListItem $item */
        $item->setBody(
            "$model->eventText " .
                (Customer::getTypeTextByType($model->getDetailOldValue('type')) ?? "not set") . ' to ' .
                (Customer::getTypeTextByType($model->getDetailNewValue('type')) ?? "not set")
        );
    }
}