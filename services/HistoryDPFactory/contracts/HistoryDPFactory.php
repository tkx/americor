<?php

namespace app\services\HistoryDPFactory\contracts;
use yii\data\DataProviderInterface;

/**
 * Abstract factory for data providers
 */
interface HistoryDPFactory {
    /** @return DataProviderInterface */
    function createDataProvider($params = null): DataProviderInterface;
}