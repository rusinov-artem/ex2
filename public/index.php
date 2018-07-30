<?php
require_once __DIR__."/../vendor/autoload.php";

/**
 * @var $c \Symfony\Component\DependencyInjection\Container
 */
$c = include __DIR__."/../boot/bootContainer.php";
include __DIR__."/../boot/bootRoutes.php";

$t1 = $c->get('t2');