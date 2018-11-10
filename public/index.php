<?php
require_once __DIR__."/../vendor/autoload.php";

$app = include __DIR__."/../boot/bootApp.php";
$app->handle($_SERVER['REQUEST_URI']);
