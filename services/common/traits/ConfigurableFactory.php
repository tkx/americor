<?php

namespace app\services\common\traits;

/**
 * Abstract factory that can be configured by storing a list of self implementations, at the same time holding singleton for each of self implementations.
 */
trait ConfigurableFactory {
    /**
     * @var array<string, object> Stores factory names and corresponding singletoned objects.
     */
    protected static $_registry = [];

    /**
     * Implement config here, as ["type" => Class::class].
     * @return array<string, string>
     */
    abstract protected static function getFactoryConfig(): array;

    public static function getInstance(string $name): self {
        if(array_key_exists($name, static::$_registry)) {
            return static::$_registry[$name];
        }

        $cfg = static::getFactoryConfig();
        return static::$_registry[$name] = new $cfg[$name]();
    }

    protected function __construct() {}
}