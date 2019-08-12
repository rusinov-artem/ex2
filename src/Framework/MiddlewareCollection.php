<?php


namespace Rusinov\Ex2\Framework;


use Rusinov\Ex2\Action;
use Rusinov\Ex2\Framework\AbstractMiddleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareCollection
{
    /**
     * @var AbstractMiddleware[]
     */
    public $collection = [];

    public function __construct(array $middleware)
    {
        $this->collection = $middleware;
    }

    public function before(Action $action, Request &$request, Response &$response)
    {
        foreach ($this->collection as $middleware)
        {
            $middleware->before($action, $request, $response);
        }
    }

    public function after(Action $action, Request &$request, Response &$response)
    {
        foreach ($this->collection as $middleware)
        {
            $middleware->after($action, $request, $response);
        }
    }

}