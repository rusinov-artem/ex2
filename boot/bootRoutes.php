<?php
/**
 * @see  __DIR__."/../config/params.php"
 * @var array $params
 */

use Symfony\Component\Routing\Generator\Dumper\CompiledUrlGeneratorDumper;
use Symfony\Component\Routing\Matcher\Dumper\CompiledUrlMatcherDumper;


$routMatcherFile = __DIR__ . "/../storage/routeMatcher.php";
$routeGeneratorFile = __DIR__ . "/../storage/routeGenerator.php";
if(file_exists($routMatcherFile) && file_exists($routeGeneratorFile))
{
    if(!$params['development']) return;
}

$rCollection = include __DIR__."/../conifg/routes.php";

$md = new CompiledUrlMatcherDumper($rCollection);
file_put_contents( $routMatcherFile,$md->dump());

$gd = new CompiledUrlGeneratorDumper($rCollection);
file_put_contents(__DIR__."/../storage/routeGenerator.php",$gd->dump());