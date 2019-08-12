<?php


namespace Rusinov\Ex2\Controller;


use Rusinov\Ex2\Entity\YCoordinate;

class HomeController extends BaseController
{

    public $layout = "layout.php";

    public function __construct()
    {

    }

    public function index( YCoordinate $c )
    {

        var_dump($c);
        return $this->render('index.php', []);
    }

    public function home()
    {
        var_dump('home');
    }
}