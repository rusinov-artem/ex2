<?php


namespace Rusinov\Ex2\Framework\Route;


use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class RouteBuilder
{
    /**
     * @var RouteCollection
     */
    public $collection;

    public function __construct()
    {
        $this->collection = new RouteCollection();
    }

    public function add($method, $path, $action, $name, $middleware = [])
    {
        $route = new Route($path, ['_controller' => $action[0], '_action'=>$action[1]]);
        $route->setMethods($method);
        $route->setDefault('middleware', $middleware);
        $this->collection->add($name, $route);
        return $route;
    }

    public function get($path, $action, $name, $middleware = [])
    {
        return $this->add('GET', $path, $action, $name, $middleware);
    }

    public function post($path, $action, $name, $middleware = [])
    {
        return $this->add('POST', $path, $action, $name, $middleware);
    }

    public function put($path, $action, $name, $middleware = [])
    {
        return $this->add('PUT', $path, $action, $name, $middleware);
    }

    public function patch($path, $action, $name, $middleware = [])
    {
        return $this->add('PATCH', $path, $action, $name, $middleware);
    }

    public function delete($path, $action, $name, $middleware = [])
    {
        return $this->add('DELETE', $path, $action, $name, $middleware);
    }

    public function middleware($middleware, callable $fnc){
        $rb = new RouteBuilder();
        $fnc($rb);
        foreach ($rb->collection->all() as $name => $route)
        {
            $mdlw = $route->getDefault('middleware');
            $mdlw = array_merge($mdlw, $middleware);
            $route->setDefault('middleware', $mdlw);
            $this->collection->add($name, $route);
        }
    }



}