<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use app\models\Customer;

/**
 * @inheritDoc
 */
class CustomerQualityBodyMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        $item->setBody(
            "$model->eventText " .
            (Customer::getQualityTextByQuality($model->getDetailOldValue('quality')) ?? "not set") . ' to ' .
            (Customer::getQualityTextByQuality($model->getDetailNewValue('quality')) ?? "not set")
        );
    }
}