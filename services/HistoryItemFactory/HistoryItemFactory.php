<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory;
use app\models\History;
use app\services\common\contracts\NamedInstance;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\services\common\traits\ConfigurableFactory;

/**
 * @inheritDoc
 * 
 * Factory configuration
 */
abstract class HistoryItemFactory implements \app\services\HistoryItemFactory\contracts\HistoryItemFactory, NamedInstance {
    use ConfigurableFactory;

    protected static function getFactoryConfig(): array {
        return [
            "list" => HistoryListItemFactory::class,
            "export" => HistoryExportItemFactory::class,
        ];
    }

    /////////////////////////////////////////////////////////////////////////

    /**
     * Specifies how to fill empty DTO created by getItem()
     */
    abstract protected function getConfig(): array;
    /** Returns emty newly created DTO for a model and use-case */
    abstract protected function getItem(History $model): HistoryItem;

    /**
     * By concrete item factory config - creates an item.
     */
    public function createItem(History $model): HistoryItem {
        $item = $this->getItem($model);

        $cfg = $this->getConfig();

        $methods = array_key_exists($model->event, $cfg) 
            ? $cfg[$model->event] 
            : $cfg[History::EVENT_DEFAULT];

        foreach($methods as $method) {
            (new $method())($item);
        }

        return $item;
    }
}