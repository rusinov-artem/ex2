<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class ProjectUrlMatcher extends Symfony\Component\Routing\Matcher\UrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/' => [[['_route' => 'home', '_controller' => 'Rusinov\\Ex2\\Controller\\HomeController', '_action' => 'index'], null, null, null, false, false, null]],
            '/home' => [[['_route' => 'hom2', 't' => 'alskdfj', '_controller' => 'Rusinov\\Ex2\\Controller\\HomeController', '_action' => 'home'], null, null, null, false, false, null]],
        ];
    }
}
