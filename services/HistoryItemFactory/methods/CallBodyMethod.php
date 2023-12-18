<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use yii\helpers\Html;

/**
 * @inheritDoc
 */
class CallBodyMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        $call = $model->call;
        $item->setBody(
            ($call 
                ? $call->totalStatusText . (
                    $call->getTotalDisposition(false) 
                        ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" 
                        : ""
                ) 
                : '<i>Deleted</i> ')
        );
    }
}