<?php

namespace app\services\HistoryItemFactory\contracts;
use app\models\History;

/**
 * History model DTO
 */
interface HistoryItem {
    function getModel(): History;
    function getBody(): string;

    function setModel(History $model);
    function setBody(string $body);
}