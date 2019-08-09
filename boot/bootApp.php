<?php


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Rusinov\Ex2\HttpApp;
use Rusinov\Ex2\LogSystem\LogHandler;
use Symfony\Component\DependencyInjection\Container;
$params = include __DIR__."/../conifg/parameters.php";
return
    (function($params)
    {
        /**
         * @var $c Container
         */

        $c = include __DIR__."/../boot/bootContainer.php";
        $d = include __DIR__."/../boot/bootEventDispatcher.php";
        include __DIR__."/../boot/bootRoutes.php";


        $app = new HttpApp();
        $app->container = $c;
        $app->params = $params;
        $app->dispatcher = $d;


        return $app;
    })($params);

