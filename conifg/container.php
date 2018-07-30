<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;

$container = new ContainerBuilder();

$container->register('t1', \Rusinov\Ex2\T1::class)
    ->addArgument('Hello')
    ->setPublic(true);


$cp = new Rusinov\Ex2\CP\cp1();
$container->addCompilerPass($cp);

return $container;
