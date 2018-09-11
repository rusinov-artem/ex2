<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$rCollection = new RouteCollection();

$route = new Route("/", ['_controller'=>\Rusinov\Ex2\Controller\HomeController::class, '_action'=>'index']);
$rCollection->add('home', $route);

$route = new Route('/home', ['_i'=>'alskdfj']);
$rCollection->add('hom2', $route);

return $rCollection;