<?php

use Rusinov\Ex2\Controller\HomeController;
use Rusinov\Ex2\Controller\MapAPIController;
use Rusinov\Ex2\Framework\Route\RouteBuilder;
use Rusinov\Ex2\Middleware\SimpleMiddleware;

$rb = new RouteBuilder();

$mw = [ SimpleMiddleware::class ];

$rb->get(    '/',                 [ HomeController::class,        'index'        ],       'home',             []  );
$rb->get(    '/home',             [ HomeController::class,        'home'         ],       'hom2',             []  );
$rb->post(   '/savePoint',        [ MapAPIController::class,      'addPosition'  ],       'savePoint',        $mw );
$rb->get(    '/getAllPoints',     [ MapAPIController::class,      'getAll'       ],       'getAllPositions',  []  );

return $rb->collection;