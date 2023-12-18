<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory\methods;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\HistoryListItem;
use app\services\HistoryItemFactory\contracts\HistoryItemMethod;
use app\models\Call;

/**
 * @inheritDoc
 */
class CallParamsMethod implements HistoryItemMethod {
    public function __invoke(HistoryItem $item) {
        $model = $item->getModel();
        $call = $model->call;
        $answered = $call && $call->status == Call::STATUS_ANSWERED;

        /** @var HistoryListItem $item */
        $item->setParams([
            'user' => $model->user,
            'content' => $call->comment ?? '',
            'footerDatetime' => $model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
        ]);
    }
}