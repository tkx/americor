<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use app\services\HistoryItemFactory\HistoryListItem;
use app\models\Sms;

/**
 * @inheritDoc
 */
class DefaultParamsMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        
        /** @var HistoryListItem $item */
        $item->setParams([
            'user' => $model->user,
            'bodyDatetime' => $model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ]);
    }
}