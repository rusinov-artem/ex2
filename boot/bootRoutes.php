<?php

use Symfony\Component\Routing\Generator\Dumper\PhpGeneratorDumper;
use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherDumper;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

if(file_exists(__DIR__."/../storage/routeMatcher.php") && file_exists(__DIR__."/../storage/routeGenerator"))
{
    //return;
}

$rCollection = include __DIR__."/../conifg/routes.php";

$md = new PhpMatcherDumper($rCollection);
file_put_contents( __DIR__."/../storage/routeMatcher.php",$md->dump());

$gd = new PhpGeneratorDumper($rCollection);
file_put_contents(__DIR__."/../storage/routeGenerator.php",$gd->dump());