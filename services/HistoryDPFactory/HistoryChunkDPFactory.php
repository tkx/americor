<?php declare(strict_types=1);

namespace app\services\HistoryDPFactory;
use app\models\search\HistorySearch;
use yii\data\DataProviderInterface;

/**
 * @inheritDoc
 * 
 * Creates History data provider
 */
class HistoryChunkDPFactory extends HistoryDPFactory {
    /** @inheritDoc */
    public function createDataProvider($params = null): DataProviderInterface {
        return (new HistorySearch())->chunk($params);
    }
}