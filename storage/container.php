<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/*
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class ProjectServiceContainer extends Container
{
    private $parameters;
    private $targetDirs = [];

    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services = $this->privates = [];
        $this->methodMap = [
            'Rusinov\\Ex2\\Controller\\HomeController' => 'getHomeControllerService',
            'Rusinov\\Ex2\\Services\\Service1' => 'getService1Service',
            'Symfony\\Component\\Routing\\Matcher\\UrlMatcher' => 'getUrlMatcherService',
            'Symfony\\Component\\Routing\\RequestContext' => 'getRequestContextService',
            't1' => 'getT1Service',
        ];
        $this->aliases = [
            't2' => 't1',
        ];
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function getRemovedIds()
    {
        return [
            'Psr\\Container\\ContainerInterface' => true,
            'Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
        ];
    }

    /*
     * Gets the public 'Rusinov\Ex2\Controller\HomeController' shared autowired service.
     *
     * @return \Rusinov\Ex2\Controller\HomeController
     */
    protected function getHomeControllerService()
    {
        return $this->services['Rusinov\Ex2\Controller\HomeController'] = new \Rusinov\Ex2\Controller\HomeController();
    }

    /*
     * Gets the public 'Rusinov\Ex2\Services\Service1' shared service.
     *
     * @return \Rusinov\Ex2\Services\Service1
     */
    protected function getService1Service()
    {
        return $this->services['Rusinov\Ex2\Services\Service1'] = new \Rusinov\Ex2\Services\Service1('aasdf', 'aasdf');
    }

    /*
     * Gets the public 'Symfony\Component\Routing\Matcher\UrlMatcher' shared service.
     *
     * @return \Symfony\Component\Routing\Matcher\UrlMatcher
     */
    protected function getUrlMatcherService()
    {
        return $this->services['Symfony\Component\Routing\Matcher\UrlMatcher'] = \Rusinov\Ex2\Factory\RouterFactory::getUrlMatcher(($this->services['Symfony\Component\Routing\RequestContext'] ?? $this->getRequestContextService()));
    }

    /*
     * Gets the public 'Symfony\Component\Routing\RequestContext' shared service.
     *
     * @return \Symfony\Component\Routing\RequestContext
     */
    protected function getRequestContextService()
    {
        return $this->services['Symfony\Component\Routing\RequestContext'] = \Rusinov\Ex2\Factory\RouterFactory::getContext();
    }

    /*
     * Gets the public 't1' shared service.
     *
     * @return \Rusinov\Ex2\T1
     */
    protected function getT1Service()
    {
        return $this->services['t1'] = new \Rusinov\Ex2\T1('Hello');
    }

    public function getParameter($name)
    {
        $name = (string) $name;

        if (!(isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name)
    {
        $name = (string) $name;

        return isset($this->parameters[$name]) || isset($this->loadedDynamicParameters[$name]) || array_key_exists($name, $this->parameters);
    }

    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = [];
    private $dynamicParameters = [];

    /*
     * Computes a dynamic parameter.
     *
     * @param string $name The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
    }

    /*
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return [
            'aasdf' => 'alskdfj',
        ];
    }
}
