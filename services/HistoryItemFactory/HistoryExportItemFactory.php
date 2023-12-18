<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory;

use app\models\History;

use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\HistoryItemFactory\methods\{CallBodyMethod, CallParamsMethod};
use app\services\HistoryItemFactory\methods\{CustomerTypeParamsMethod, CustomerQualityParamsMethod};
use app\services\HistoryItemFactory\methods\{CustomerTypeBodyMethod, CustomerQualityBodyMethod};
use app\services\HistoryItemFactory\methods\{CommonItemMethod, StatusChangeItemMethod};
use app\services\HistoryItemFactory\methods\{DefaultBodyMethod, DefaultParamsMethod};
use app\services\HistoryItemFactory\methods\{FaxBodyMethod, FaxParamsMethod};
use app\services\HistoryItemFactory\methods\{SmsBodyMethod, SmsParamsMethod};
use app\services\HistoryItemFactory\methods\{TaskBodyMethod, TaskParamsMethod};

/**
 * @inheritDoc
 * 
 * History DTO Factory specifying how exactly DTOs should be created using Methods
 */
class HistoryExportItemFactory extends HistoryItemFactory
{
    protected function getItem(History $model): HistoryItem {
        return new HistoryExportItem($model);
    }

    /**
     * @inheritDoc
     * Shows which DTO the app needs depending on model data
     */
    protected function getConfig(): array {
        return [
            History::EVENT_CREATED_TASK => [TaskBodyMethod::class],
            History::EVENT_COMPLETED_TASK => [TaskBodyMethod::class],
            History::EVENT_UPDATED_TASK => [TaskBodyMethod::class],
            
            History::EVENT_INCOMING_SMS => [SmsBodyMethod::class],
            History::EVENT_OUTGOING_SMS => [SmsBodyMethod::class],
            
            History::EVENT_OUTGOING_FAX => [FaxBodyMethod::class],
            History::EVENT_INCOMING_FAX => [FaxBodyMethod::class],
            
            History::EVENT_CUSTOMER_CHANGE_TYPE => [CustomerTypeBodyMethod::class],
            History::EVENT_CUSTOMER_CHANGE_QUALITY => [CustomerQualityBodyMethod::class],
            
            History::EVENT_INCOMING_CALL => [CallBodyMethod::class],
            History::EVENT_OUTGOING_CALL => [CallBodyMethod::class],
            
            History::EVENT_DEFAULT => [DefaultBodyMethod::class],
        ];
    }
}