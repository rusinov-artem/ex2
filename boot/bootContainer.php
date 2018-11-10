<?php

use Symfony\Component\DependencyInjection\Dumper\PhpDumper;

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
$container->compile();

$dumper = new PhpDumper($container);

file_put_contents(__DIR__."/../storage/container.php", $dumper->dump(['debug'=>false]));

return $container;