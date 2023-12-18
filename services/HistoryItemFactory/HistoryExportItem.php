<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory;
use app\services\HistoryItemFactory\contracts\HistoryItem;
use app\models\History;

/**
 * @inheritDoc
 * 
 * History model DTO
 */
class HistoryExportItem implements HistoryItem {
    private $model;
    private $body;

    public function __construct(History $model) {
        $this->model = $model;
        $this->body = "";
    }

    public function getModel(): History {
        return $this->model;
    }
    public function getBody(): string {
        return $this->body;
    }

    public function setModel(History $model) {
        $this->model = $model;
    }
    public function setBody(string $body) {
        $this->body = $body;
    }
}