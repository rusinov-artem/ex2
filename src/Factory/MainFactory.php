<?php


namespace Rusinov\Ex2\Factory;


use Symfony\Component\HttpFoundation\Request;

class MainFactory
{
    public static function getRequest()
    {
        return Request::createFromGlobals();
    }
}