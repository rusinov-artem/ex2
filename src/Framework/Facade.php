<?php


namespace Rusinov\Ex2\Framework;


abstract class Facade
{
    protected static $instance;

    abstract protected static function getInstance();

    public static function __callStatic($name, $arguments){
        $instance = static::getInstance();
        return $instance->$name(...$arguments);
    }
}