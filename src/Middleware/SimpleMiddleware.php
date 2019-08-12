<?php


namespace Rusinov\Ex2\Middleware;


use Rusinov\Ex2\Action;
use Rusinov\Ex2\Entity\YCoordinate;
use Rusinov\Ex2\Framework\AbstractMiddleware;
use Rusinov\Ex2\HttpApp;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SimpleMiddleware extends AbstractMiddleware
{
    /**
     * @var HttpApp
     */
    public $app;

    public function before(Action &$action, Request &$request, Response &$response)
    {

        var_dump('Before');
        $coord = new YCoordinate();
        $data = $request->get('coord');
        $coord->latitude = $data['latitude'];
        $coord->longitude = $data['longitude'];
        $action->parameters['c'] = $coord;

    }

    public function after(Action $action, Request &$request, Response &$response)
    {
        var_dump('After');
    }
}