<?php


namespace Rusinov\Ex2\Controller;


use Rusinov\Ex2\Services\Service1;

class HomeController extends BaseController
{

    public function __construct()
    {

    }

    public function index()
    {
        return $this->render('index.php', []);
    }

    public function home($t=null)
    {
        var_dump('home');
    }
}