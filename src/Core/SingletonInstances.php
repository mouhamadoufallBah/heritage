<?php

namespace App\Core;

class SingletonInstances
{
    private static array $instances = [];

    public static function get(string $className): object
    {
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new $className();
        }
        return self::$instances[$className];
    }
}
