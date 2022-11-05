<?php

use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;

require __DIR__."/../vendor/autoload.php";

/** @var \Rusinov\Ex2\HttpApp $app */
$app = include __DIR__."/../boot/bootApp.php";

$consoleApp = new \Symfony\Component\Console\Application("ex2", "0.0.1");
/** @var ContainerCommandLoader $commandLoader */
$commandLoader = $app->container->get('console.command_loader');
$consoleApp->setCommandLoader($commandLoader, []);
$consoleApp->run();