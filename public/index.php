<?php
ini_set("display_startup_errors",1);
ini_set('display_errors',1);

use Rusinov\Ex2\HttpApp;
use Symfony\Contracts\EventDispatcher\Event;

require_once __DIR__."/../vendor/autoload.php";

/**
 * @var $app HttpApp
 */
$app = include __DIR__."/../boot/bootApp.php";
echo $app->handle($_SERVER['REQUEST_URI']);

$mw = $app->container->get(\Rusinov\Ex2\Middleware\ModelBinding::class);
var_dump($mw);

