<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory;

use app\models\Call;
use app\models\Customer;
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
use app\services\HistoryItemFactory\methods\WhatsAppMethod;

class HistoryListItemFactory extends HistoryItemFactory
{
    protected function getItem(History $model): HistoryItem {
        return new HistoryListItem($model);
    }

    /**
     * @inheritDoc
     * Shows which DTO the app needs depending on model data
     */
    protected function getConfig(): array {
        return [
            /** demo event - whatsapp */
            History::EVENT_WHATSAPP_MESSAGE => [CommonItemMethod::class, WhatsAppMethod::class,],

            History::EVENT_CREATED_TASK => [CommonItemMethod::class, TaskBodyMethod::class, TaskParamsMethod::class,],
            History::EVENT_COMPLETED_TASK => [CommonItemMethod::class, TaskBodyMethod::class, TaskParamsMethod::class,],
            History::EVENT_UPDATED_TASK => [CommonItemMethod::class, TaskBodyMethod::class, TaskParamsMethod::class,],
            
            History::EVENT_INCOMING_SMS => [CommonItemMethod::class, SmsBodyMethod::class, SmsParamsMethod::class],
            History::EVENT_OUTGOING_SMS => [CommonItemMethod::class, SmsBodyMethod::class, SmsParamsMethod::class],
            
            History::EVENT_OUTGOING_FAX => [CommonItemMethod::class, FaxBodyMethod::class, FaxParamsMethod::class],
            History::EVENT_INCOMING_FAX => [CommonItemMethod::class, FaxBodyMethod::class, FaxParamsMethod::class],
            
            History::EVENT_CUSTOMER_CHANGE_TYPE => [StatusChangeItemMethod::class, CustomerTypeParamsMethod::class],
            History::EVENT_CUSTOMER_CHANGE_QUALITY => [StatusChangeItemMethod::class, CustomerQualityParamsMethod::class],
            
            History::EVENT_INCOMING_CALL => [CommonItemMethod::class, CallBodyMethod::class, CallParamsMethod::class],
            History::EVENT_OUTGOING_CALL => [CommonItemMethod::class, CallBodyMethod::class, CallParamsMethod::class],
            
            History::EVENT_DEFAULT => [CommonItemMethod::class, DefaultBodyMethod::class, DefaultParamsMethod::class],
        ];
    }
}