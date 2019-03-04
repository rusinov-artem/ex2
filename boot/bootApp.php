<?php


use Rusinov\Ex2\HttpApp;
use Symfony\Component\DependencyInjection\Container;

return
    (function()
    {
        /**
         * @var $c Container
         */
        $params = include __DIR__."/../conifg/parameters.php";
        $c = include __DIR__."/../boot/bootContainer.php";
        $d = include __DIR__."/../boot/bootEventDispatcher.php";
        include __DIR__."/../boot/bootRoutes.php";


        $app = new HttpApp();
        $app->container = $c;
        $app->params = $params;
        $app->dispatcher = $d;
        return $app;
    })();

