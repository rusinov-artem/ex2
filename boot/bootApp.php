<?php


return
    (function()
    {
        /**
         * @var $c \Symfony\Component\DependencyInjection\Container
         */
        $params = include __DIR__."/../conifg/parameters.php";
        $c = include __DIR__."/../boot/bootContainer.php";
        include __DIR__."/../boot/bootRoutes.php";


        $app = new \Rusinov\Ex2\HttpApp();
        $app->container = $c;
        $app->params = $params;
        return $app;
    })();

