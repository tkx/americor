<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\HistoryDPFactory\HistoryDPFactory;
use app\services\HistoryItemFactory\HistoryItemFactory;

/**
 * Bring the code to strictly applying MVVC pattern, where:
 * Models are for DB operations (M),
 * Controllers are mainly telling which top-level views to use (C),
 * Controller views (main app /views) publishing widgets and basic case markup (first V),
 * Widgets are main part, they are tieing services with views. Views are forming the widget output (second V).
 * Services are main logic part, they interact with databases and serve to prepare and return data from data sources.
 * 
 * The process of forming the response is as follows (something like MVWVC):
 * controller -> controller view -> widget(s) -> +services -> widget view -> response
 * 
 * ps. Actions are tied with concrete instances, to decouple - move instance names to config (env).
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays history output and exporting options.
     * Configured with services.
     * @return string
     */
    public function actionIndex()
    {
        $fullDataProvider = HistoryDPFactory::getInstance("full")->createDataProvider(Yii::$app->request->queryParams);
        $dataProvider = $fullDataProvider;
        $itemFactory = HistoryItemFactory::getInstance("list");

        return $this->render('index', [
            "export_chunk_size" => 100,
            "export_fullDataProvider" => $fullDataProvider,
            'list_dataProvider' => $dataProvider,
            'list_itemFactory' => $itemFactory,
        ]);
    }

    /**
     * Runs actual export.
     * Configured with services.
     * @return string
     */
    public function actionExport($exportType, $type, $chunk=0, $exportAction=null)
    {
        $dataProvider = HistoryDPFactory::getInstance($type)->createDataProvider(Yii::$app->request->queryParams);
        $itemFactory = HistoryItemFactory::getInstance("export");

        return $this->render('export', [
            "type" => $type,
            "chunk" => $chunk,
            'exportType' => $exportType,
            "exportAction" => $exportAction,

            "dataProvider" => $dataProvider,
            "itemFactory" => $itemFactory,
        ]);
    }
}
