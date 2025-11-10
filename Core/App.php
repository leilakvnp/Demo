<?php

namespace Core;

class App
{
    protected static $container;
    public static function setContainer($container)
    {
        static::$container = $container;
    }
    public static function Container()
    { // or getContainer
        return static::$container;
    }

    public static function bind(string $key, callable $resolver)//?where use it??
    {
        static::Container()->bind($key, $resolver);
    }
    public static function resolve(string $key)
    {
        return static::Container()->resolve($key);
    }
}
