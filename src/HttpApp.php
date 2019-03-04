<?php


namespace Rusinov\Ex2;

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
            var_dump($t);
        }


        $action = new Action();
        $action->controller = $route['_controller'];
        $action->method = $route['_action'];
        $action->parameters = $route;

        return  $this->run($action);
    }

    public function run(Action $action)
    {
        $controller = $this->container->get($action->controller);
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
}