<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

$containerFileName = __DIR__."/../storage/container.php";
if(file_exists($containerFileName))
{
    if($params['development'] == false)
    {
        require_once $containerFileName;
        return new ProjectServiceContainer;
    }
}
$container = new ContainerBuilder();


$fl = new PhpFileLoader($container, new FileLocator());
$def = new Definition();
$def->setAutowired(true)->setAutoconfigured(true)->setPublic(true);
//$fl->load($def, );
$fl->registerClasses($def, "Rusinov\\Ex2\\Middleware\\", __DIR__."/../src/Middleware");
$fl->registerClasses($def, "Rusinov\\Ex2\\Repository\\", __DIR__."/../src/Repository");
$fl->registerClasses($def, "Rusinov\\Ex2\\Controller\\", __DIR__."/../src/Controller");
$container = include __DIR__."/../conifg/container.php";
$container->compile();

$dumper = new PhpDumper($container);

file_put_contents(__DIR__."/../storage/container.php", $dumper->dump(['debug'=>false]));

return $container;