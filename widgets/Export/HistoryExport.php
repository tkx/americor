<?php declare(strict_types=1);

namespace app\widgets\Export;
use yii\base\Widget;
use app\services\HistoryItemFactory\HistoryItemFactory;
use yii\data\DataProviderInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

/**
 * Exporting logic combined in this widget, acting as a front to all export operations.
 * Ran in 2 modes - showing export controls and actual export.
 * Backed by services: DataProvider factory, DTO factory.
 * 
 * Using two widget views - exporting form and actual export.
 * 
 * Export to a downloadable file offered with 3 options:
 * 1. full immediate download in case of small volume of total data.
 * 2. chunked immediate download - parts of data available in distinct files. By count, by date (not implemented).
 * 3. (not implemented) schedule export with queues and background processes. possible implementation includes:
 * 3.1. run rabbitmq with a queue dedicated to exports.
 * 3.1.1. run background process(es) to consume queue messages which start(s) creating the response.
 * 3.1.2. when job is done - save and register file and push message to another queue which is dedicated to done jobs.
 * 3.2. user redirects back home where websocket connecion is opened for a job completion service.
 * 3.2.1. upon receiving message with "done" export, ws server notifies client, show the file.
 */
class HistoryExport extends Widget {
    
    const EXPORT_FULL = "full";
    const EXPORT_CHUNK = "chunk";
    const DEFAULT_CHUNK = 2000;
    const ACTION_FORM = 1;
    const ACTION_DOWNLOAD = 2;
    const ACTION_SCHEDULE = 3;

    public $chunk_size = self::DEFAULT_CHUNK;
    public $download_params = [];
    public $action = self::ACTION_FORM;

    /** @var DataProviderInterface */
    public $fullDataProvider;
    /** @var DataProviderInterface */
    public $dataProvider;
    /** @var HistoryItemFactory */
    public $itemFactory;

    private function getTotalCount(DataProviderInterface $dp): int {
        return $dp->getTotalCount();
    }

    private function getChunksCount(DataProviderInterface $dp): int {
        return (int) ceil($this->getTotalCount($dp) / $this->chunk_size);
    }

    private function getLink(bool $chunked = false, int $i = null, bool $queued = false)
    {
        $params = Yii::$app->getRequest()->getQueryParams();
        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = 'site/export';

        if($chunked && $i) {
            $params = ArrayHelper::merge([
                "type" => self::EXPORT_CHUNK,
                "chunk" => $i,
                "chunk_size" => $this->chunk_size,
            ], $params);
        } if($queued) {
            $params = ArrayHelper::merge([
                "type" => self::EXPORT_FULL,
                "exportAction" => self::ACTION_SCHEDULE,
            ], $params);
        } else {
            $params = ArrayHelper::merge([
                "type" => self::EXPORT_FULL,
            ], $params);
        }

        return Url::to($params);
    }

    public function run()
    {
        switch($this->action) {
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            default:
            case self::ACTION_FORM:
                $dp_full = $this->fullDataProvider;

                return $this->render('main', [
                    'total' => $this->getTotalCount($dp_full),
                    "chunks" => $this->getChunksCount($dp_full),
                    "chunk_size" => $this->chunk_size,
                    "fullLink" => $this->getLink(),
                    "queueLink" => $this->getLink(false, null, true),
                    "chunkLinkF" => function(int $i) { return $this->getLink(true, $i); },
                ]);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            case self::ACTION_DOWNLOAD:
                $type =  $this->download_params["type"];
                $chunk =  $this->download_params["chunk"];
                $exportType =  $this->download_params["exportType"];
                        
                $fileName = 'history';
                $fileName .= '-' . time();
                $fileName .= "-" . $type;
                $fileName .= $chunk ? ("-" . $chunk) : "";

                ini_set('max_execution_time', "0");
                ini_set('memory_limit', '2048M');

                $dataProvider = $this->dataProvider;
                $itemFactory = $this->itemFactory;

                return $this->render("export", [
                    'dataProvider' => $dataProvider,
                    "itemFactory" => $itemFactory,
                    "fileName" => $fileName,
                    'exportType' => $exportType,
                ]);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            case self::ACTION_SCHEDULE:
                // added to queue
                Yii::$app->session->setFlash('success', 'Export scheduled');
                return $this->render("scheduled", []);
        }
    }
}