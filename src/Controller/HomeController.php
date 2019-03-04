<?php


namespace Rusinov\Ex2\Controller;


use Rusinov\Ex2\Services\Service1;

class HomeController
{

    public function __construct()
    {

    }

    public function index(Service1 $s)
    {
        var_dump($s);
        var_dump('index method of Home Controller');
    }

    public function home($t=null)
    {
        var_dump('home');
    }
}