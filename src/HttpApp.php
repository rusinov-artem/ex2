<?php


namespace Rusinov\Ex2;

use Monolog\Logger;
use ReflectionFunction;
use ReflectionMethod;
use Rusinov\Ex2\Framework\ErrorHandler;
use Rusinov\Ex2\Framework\MiddlewareCollection;
use Rusinov\Ex2\LogSystem\_L;
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

    public $params;

    public function __construct()
    {
        $this->setErrorHandlers();
    }

    public function handle(Request $request)
    {
        _L::s("system", "try to get action");
        $action = $this->getAction($request);
        _L::s("system", "try to run action");
        $r =   $this->run($action);
        _L::s("system", "Action successfully executed");
        return $r;
    }

    public function getAction(Request $request)
    {
        /**
         * @var $matcher UrlMatcher
         */
        _L::s("system", "getting UrlMatcher throught the container");
        $matcher = $this->container->get(UrlMatcher::class);

        try{
            _L::s("system", "getting route from UrlMatcher for {$request->getMethod()} {$request->getUri()}");
            $route = $matcher->matchRequest($request);
        }
        catch (\Throwable $t)
        {
            _L::s("system", "route not found");
            return "not found";
        }

        $this->container->set(Request::class, $request);
        $action = new Action();
        $action->name = $route['_route'];
        $action->middleware = $route['middleware'] ?? [];
        $action->controller = $route['_controller'];
        $action->method = $route['_action'];
        $action->parameters = $route;

        return $action;
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

        if($result instanceof Response)
        {
            return $result;
        }

        if(is_string($result))
        {
            $response->setContent($result);
            return $response;
        }
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
        // set_error_handler([$eh, 'errorHandler']);
        // set_exception_handler([$eh, 'exceptionHandler']);
    }
}
