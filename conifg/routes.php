<?php

use Rusinov\Ex2\Controller\HomeController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$rCollection = new RouteCollection();

$route = new Route("/", ['_controller' => HomeController::class, '_action'=>'index']);
$rCollection->add('home', $route);

$route = new Route('/home', ['t' => 'alskdfj', "_controller"=>HomeController::class, '_action'=>'home']);
$rCollection->add('hom2', $route);

$mw = 'auth';
$route = new Route("/t1", ['mw'=>$mw]);
$rCollection->add('t1', $route);
return $rCollection;