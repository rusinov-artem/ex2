<?php
/**
 * @see __DIR__/../config/params.php
 * @var array $params
 */

use Symfony\Component\Routing\Generator\Dumper\CompiledUrlGeneratorDumper;
use Symfony\Component\Routing\Matcher\Dumper\CompiledUrlMatcherDumper;


if(file_exists(__DIR__."/../storage/routeMatcher.php") && file_exists(__DIR__."/../storage/routeGenerator"))
{
    if($params['development'] == false)
    {
        return;
    }
}

$rCollection = include __DIR__."/../conifg/routes.php";

$md = new CompiledUrlMatcherDumper($rCollection);
file_put_contents( __DIR__."/../storage/routeMatcher.php",$md->dump());

$gd = new CompiledUrlGeneratorDumper($rCollection);
file_put_contents(__DIR__."/../storage/routeGenerator.php",$gd->dump());