<?php declare(strict_types=1);

namespace app\services\HistoryDPFactory;
use app\services\common\contracts\NamedInstance;
use yii\data\DataProviderInterface;

/**
 * @inheritDoc
 * 
 * Factory configuration
 */
abstract class HistoryDPFactory implements \app\services\HistoryDPFactory\contracts\HistoryDPFactory, NamedInstance {
    use \app\services\common\traits\ConfigurableFactory;

    protected static function getFactoryConfig(): array {
        return [
            "full" => HistoryFullDPFactory::class,
            "chunk" => HistoryChunkDPFactory::class,
        ];
    }

    /////////////////////////////////////////////////////////////////////////
    
    /** @inheritDoc */
    abstract public function createDataProvider($params = null): DataProviderInterface;
}