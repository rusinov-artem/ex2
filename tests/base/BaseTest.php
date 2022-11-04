<?php

namespace Rusinov\Ex2\tests\base;

use PHPUnit\Framework\TestCase;
use Rusinov\Ex2\HttpApp;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

class BaseTest extends TestCase
{

    /**
     * @var HttpApp
     */
    public $app;

    public function setUp(): void
    {
        /**
         * @var $app HttpApp
         */
        $this->app = include __DIR__."/../../boot/bootApp.php";
        $this->app->container->set(RequestContext::class, RequestContext::fromUri(""));
    }

}