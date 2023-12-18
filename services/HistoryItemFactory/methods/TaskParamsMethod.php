<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use app\services\HistoryItemFactory\HistoryListItem;

/**
 * @inheritDoc
 */
class TaskParamsMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        $task = $model->task;
        
        /** @var HistoryListItem $item */
        $item->setParams([
            'user' => $model->user,
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }
}