<?php


namespace Rusinov\Ex2\Framework;


use Rusinov\Ex2\Action;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractMiddleware
{
    abstract public function before(Action &$action, Request &$request, Response &$response);
    abstract public function after(Action $action, Request &$request, Response &$response);
}