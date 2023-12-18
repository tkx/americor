<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;

/**
 * @inheritDoc
 */
class TaskBodyMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        $task = $model->task;
        $item->setBody("$model->eventText: " . ($task->title ?? ''));
    }
}