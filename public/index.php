<?php

use Rusinov\Ex2\HttpApp;
use Symfony\Component\EventDispatcher\Event;

require_once __DIR__."/../vendor/autoload.php";

/**
 * @var $app HttpApp
 */
$app = include __DIR__."/../boot/bootApp.php";
$app->handle($_SERVER['REQUEST_URI']);
$r = $app->dispatcher->dispatch('hello', new Event());

var_dump($r);