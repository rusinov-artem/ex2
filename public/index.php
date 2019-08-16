<?php
ini_set("display_startup_errors",1);
ini_set('display_errors',1);
ini_set('error_reporting', E_ALL);

use Rusinov\Ex2\HttpApp;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__."/../vendor/autoload.php";

/**
 * @var $app HttpApp
 */
$app = include __DIR__."/../boot/bootApp.php";
//echo $app->handle(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
$response =  $app->handle($request = Request::createFromGlobals());
$response->send();

