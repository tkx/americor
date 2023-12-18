<?php

use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\services\HistoryItemFactory\HistoryListItem;
use app\services\HistoryItemFactory\HistoryItemFactory;

/** @var HistoryItemFactory $itemFactory */
$itemFactory;
?>

<?php Pjax::begin(['id' => 'grid-pjax', 'formSelector' => false]); ?>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function($model, $key, $index, $widget) use($itemFactory) {
        /** @var HistoryListItem $item */
        $item = $itemFactory->createItem($model);

        return $this->render(
            $item->getView(), 
            $item->getParams()
        );
    },
    'options' => [
        'tag' => 'ul',
        'class' => 'list-group'
    ],
    'itemOptions' => [
        'tag' => 'li',
        'class' => 'list-group-item'
    ],
    'emptyTextOptions' => ['class' => 'empty p-20'],
    'layout' => '{items}{pager}',
]); ?>

<?php Pjax::end(); ?>
