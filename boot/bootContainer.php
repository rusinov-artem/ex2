<?php

use Symfony\Component\Config\FileLocator;
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

$container = include __DIR__."/../conifg/container.php";

$fl = new PhpFileLoader($container, new FileLocator());
$def = new Definition();
$def->setAutowired(true)->setAutoconfigured(true)->setPublic(true);
//$fl->load($def, );
$fl->registerClasses($def, "Rusinov\\Ex2\\Middleware\\", __DIR__."/../src/Middleware");

$container->compile();

$dumper = new PhpDumper($container);

file_put_contents(__DIR__."/../storage/container.php", $dumper->dump(['debug'=>false]));

return $container;