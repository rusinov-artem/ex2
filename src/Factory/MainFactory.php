<?php


namespace Rusinov\Ex2\Factory;


use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Cache\CacheInterface;

class MainFactory
{
    public static function getRequest()
    {
        return Request::createFromGlobals();
    }

    public static function getCache($dir):CacheInterface
    {
        $cache = new FilesystemAdapter('main', 0, $dir);
        return $cache;
    }
}