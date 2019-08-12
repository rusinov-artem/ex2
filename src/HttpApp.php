<?php


namespace Rusinov\Ex2;

use Monolog\Logger;
use ReflectionFunction;
use ReflectionMethod;
use Rusinov\Ex2\Framework\ErrorHandler;
use Rusinov\Ex2\Framework\MiddlewareCollection;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class HttpApp
{
    /**
     * @var Container
     */
    public $container;

    /**
     * @var EventDispatcher
     */
    public $dispatcher;

    /**
     * @var Logger
     */
    public $logger;

    public $viewDir = __DIR__."/../resource/views";

    public function __construct()
    {
        $this->setErrorHandlers();
    }

    public function handle($input)
    {
        /**
         * @var $matcher UrlMatcher
         */
        $matcher = $this->container->get(UrlMatcher::class);

        try{
            if(is_string($input))
            {
                $route = $matcher->match($input);
            }
            elseif($input instanceof Request)
            {
                $route = $matcher->matchRequest($input);
            }
        }
        catch (\Throwable $t)
        {
            return "not found";
        }


        $action = new Action();
        $action->name = $route['_route'];
        $action->middleware = $route['middleware'] ?? [];
        $action->controller = $route['_controller'];
        $action->method = $route['_action'];
        $action->parameters = $route;

        $r =   $this->run($action);
        return $r;
    }

    public function run(Action $action)
    {

        $controller = $this->container->get($action->controller);

        if(property_exists($controller, 'app'))
        {
            $controller->app = &$this;
        }

        $middlewareCollection = $this->getMiddlewareCollection($action);
        $request = $this->container->get(Request::class);
        $response = new Response();
        $middlewareCollection->before($action, $request, $response);
        $result =  $this->call([$controller, $action->method], $action->parameters);
        $middlewareCollection->after($action, $request, $response);
        return $result;
    }

    public function call($callback, $parameters)
    {
        $dependencies= [];

        $reflecotr = is_array($callback)
            ? new ReflectionMethod($callback[0], $callback[1])
            : new ReflectionFunction($callback);

        $cParameters = $reflecotr->getParameters();

        foreach ($cParameters as $parameter)
        {
            if(array_key_exists($parameter->name, $parameters))
            {
                $dependencies[] = $parameters[$parameter->name];
                unset($parameters[$parameter->name]);
            }
            elseif($parameter->getClass())
            {
                $dependencies[] = $this->container->get($parameter->getClass()->name);
            }
            elseif($parameter->isDefaultValueAvailable())
            {
                $dependencies[] = $parameter->getDefaultValue();
            }
        }

        return call_user_func_array($callback, $dependencies);

    }

    public function notFound()
    {
        http_send_status(404);
        return "not found";
    }

    protected function getMiddlewareCollection(Action $action)
    {
        $collection = [];
        foreach ($action->middleware as $middleware)
        {
            $middleware = $this->container->get($middleware);
            $middleware->app = $this;
            $collection[] = $middleware;
        }
        return new MiddlewareCollection($collection);
    }

    public function setErrorHandlers()
    {
        $eh = new ErrorHandler();
        set_error_handler([$eh, 'errorHandler']);
        set_exception_handler([$eh, 'exceptionHandler']);
    }
}