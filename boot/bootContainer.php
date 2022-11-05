<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/** @var Array $params */

$containerFileName = __DIR__."/../storage/container.php";
if(file_exists($containerFileName))
{
    if(!$params['development'])
    {
        require_once $containerFileName;
        return new ProjectServiceContainer;
    }
}

$container = new ContainerBuilder();


$fl = new PhpFileLoader($container, new FileLocator());
$def = (new Definition())->setAutowired(true)->setAutoconfigured(true)->setPublic(true);
$fl->registerClasses($def, "Rusinov\\Ex2\\Middleware\\", __DIR__."/../src/Middleware");
$fl->registerClasses($def, "Rusinov\\Ex2\\Repository\\", __DIR__."/../src/Repository");
$fl->registerClasses($def, "Rusinov\\Ex2\\Controller\\", __DIR__."/../src/Controller");

$def = (new Definition())->setAutowired(true)->setAutoconfigured(true)->setPublic(true)->addTag("console.command");
$fl->registerClasses($def, "Rusinov\\Ex2\\Console\\", __DIR__."/../src/Console");

$container->addCompilerPass(new \Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass());

(include __DIR__."/../conifg/container.php")->compile();

$dumper = new PhpDumper($container);

file_put_contents($containerFileName, $dumper->dump(['debug'=>false]));

require_once $containerFileName;
return new ProjectServiceContainer;