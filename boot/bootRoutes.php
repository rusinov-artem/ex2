<?php

if(file_exists(__DIR__."/../storage/routeMatcher.php") && file_exists(__DIR__."/../storage/routeGenerator"))
    return;

$rCollection = new \Symfony\Component\Routing\RouteCollection();

$route = new \Symfony\Component\Routing\Route("/", ['_controller'=>'hello', '_action'=>'index']);
$rCollection->add('home', $route);

$context = new \Symfony\Component\Routing\RequestContext("/");


$md = new \Symfony\Component\Routing\Matcher\Dumper\PhpMatcherDumper($rCollection);
file_put_contents( __DIR__."/../storage/routeMatcher.php",$md->dump());

$gd = new \Symfony\Component\Routing\Generator\Dumper\PhpGeneratorDumper($rCollection);
file_put_contents(__DIR__."/../storage/routeGenerator",$gd->dump());