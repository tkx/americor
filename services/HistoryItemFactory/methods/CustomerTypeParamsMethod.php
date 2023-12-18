<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use app\services\HistoryItemFactory\HistoryListItem;
use app\models\Customer;

/**
 * @inheritDoc
 */
class CustomerTypeParamsMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        
        /** @var HistoryListItem $item */
        $item->setParams([
            'model' => $model,
            'oldValue' => Customer::getTypeTextByType($model->getDetailOldValue('type')),
            'newValue' => Customer::getTypeTextByType($model->getDetailNewValue('type'))
        ]);
    }
}