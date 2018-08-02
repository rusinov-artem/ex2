<?php

use Rusinov\Ex2\Controller\HomeController;
use Rusinov\Ex2\Factory\RouterFactory;
use Rusinov\Ex2\Services\Service1;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$container = new ContainerBuilder();


$container->setParameter('aasdf','alskdfj');

$container->register('t1', \Rusinov\Ex2\T1::class)
    ->addArgument('Hello')
    ->setPublic(true);

$container->register(UrlMatcher::class )
    ->setFactory([RouterFactory::class, 'getUrlMatcher'])
    ->addArgument(new Reference(RequestContext::class))
    ->setPublic(true)->setShared(true);

$container->register(RequestContext::class)
    ->setFactory([RouterFactory::class, 'getContext'])
    ->setPublic('true')->setShared(true);

$container->register(Service1::class)
    ->addArgument('aasdf')
    ->addArgument('aasdf')
    ->setPublic(true);

$container->register(HomeController::class)
    ->setPublic(true)->setAutowired(true);

$cp = new Rusinov\Ex2\CP\cp1();
$container->addCompilerPass($cp);

return $container;
