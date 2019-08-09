<?php


namespace Rusinov\Ex2;

use Monolog\Logger;
use ReflectionFunction;
use ReflectionMethod;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
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
            $this->logger->err(throwableToString($t));
            return "not found";
        }


        $action = new Action();
        $action->controller = $route['_controller'];
        $action->method = $route['_action'];
        $action->parameters = $route;

        $r =   $this->run($action);
        $this->logger->info("App successfully handled request", ['system']);
        return $r;
    }

    public function run(Action $action)
    {
        $controller = $this->container->get($action->controller);

        if(property_exists($controller, 'app'))
        {
            $controller->app = &$this;
        }

        return $this->call([$controller, $action->method], $action->parameters);
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
}