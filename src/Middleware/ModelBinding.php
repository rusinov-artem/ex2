<?php


namespace Rusinov\Ex2\Middleware;


use Rusinov\Ex2\Action;
use Rusinov\Ex2\Framework\AbstractMiddleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModelBinding extends AbstractMiddleware
{

    public function before(Action &$action, Request &$request, Response &$response)
    {

    }

    public function after(Action $action, Request &$request, Response &$response)
    {
    }
}