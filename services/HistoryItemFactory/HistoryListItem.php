<?php declare(strict_types=1);

namespace app\services\HistoryItemFactory;
use app\models\History;
use app\services\HistoryItemFactory\contracts\HistoryItem;

/**
 * @inheritDoc
 * 
 * History model DTO
 */
class HistoryListItem implements HistoryItem {
    private $model;
    private $view;
    private $params;

    public function __construct(History $model) {
        $this->model = $model;
        $this->view = "";
        $this->params = [];
    }

    public function getModel(): History {
        return $this->model;
    }
    public function getView(): string {
        return $this->view;
    }
    public function getParams(): array {
        return $this->params;
    }
    public function getBody(): string {
        return $this->params["body"];
    }

    public function setModel(History $model) {
        $this->model = $model;
    }
    public function setView(string $name) {
        $this->view = $name;
    }
    public function setBody(string $body) {
        $this->setParams(["body" => $body]);
    }
    public function setParams(array $params) {
        if(!$this->params) {
            $this->params = [];
        }
        
        foreach($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }
}