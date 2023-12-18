<?php

namespace app\widgets\HistoryList;

use yii\data\DataProviderInterface;
use app\services\HistoryItemFactory\HistoryItemFactory;
use yii\base\Widget;

/**
 * History output widget; backed by services: DataProvider factory and DTO objects factory.
 */
class HistoryList extends Widget
{
    /** @var DataProviderInterface $dataProvider */
    public $dataProvider;
    /** @var HistoryItemFactory $itemFactory */
    public $itemFactory;
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('main', [
            'dataProvider' => $this->dataProvider,
            'itemFactory' => $this->itemFactory,
        ]);
    }
}
