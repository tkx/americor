<?php

namespace app\services\common\contracts;

/**
 * Abstract named singletons registry
 */
interface NamedInstance {
    static function getInstance(string $name);
}