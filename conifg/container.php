<?php

use Doctrine\DBAL\Connection;
use Rusinov\Ex2\Controller\HomeController;
use Rusinov\Ex2\Factory\DbConnectionFactory;
use Rusinov\Ex2\Factory\MainFactory;
use Rusinov\Ex2\Factory\RouterFactory;
use Rusinov\Ex2\Repository\FS\YCoordinateRepository;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\FileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Contracts\Cache\CacheInterface;

/**  @var FileLoader $this */
/** @var Array $params */

/** @var ContainerBuilder $container */
$container->register(Connection::class)
    ->setFactory([DbConnectionFactory::class, 'getDBConnection'])
    ->addArgument($params)
    ->setPublic(true);

$container->register(UrlMatcher::class )
    ->setFactory([RouterFactory::class, 'getUrlMatcher'])
    ->addArgument(new Reference(RequestContext::class))
    ->setPublic(true)->setShared(true);

$container->register(RequestContext::class)
    ->setFactory([RouterFactory::class, 'getContext'])
    ->setPublic('true')->setShared(true);

$container->register(HomeController::class)
    ->setPublic(true)->setAutowired(true);

$container->register(YCoordinateRepository::class, YCoordinateRepository::class)
    ->setProperties(['dir'=>$params['YCoordinateRepository']['dir']])
    //->addMethodCall('setDir', ['dir'=>$params['YCoordinateRepository']['dir']])
    ->setPublic(true);


$container->register(CacheInterface::class)
    ->setFactory([MainFactory::class, 'getCache'])
    ->setArgument('$dir', $params['cache']['dir'])
    ->setPublic(true)->setAutowired(true);

return $container;
