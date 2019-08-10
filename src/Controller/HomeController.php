<?php


namespace Rusinov\Ex2\Controller;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Rusinov\Ex2\Services\Service1;

class HomeController extends BaseController
{

    public $layout = "layout.php";

    public function __construct()
    {

    }

    public function index(Connection $db)
    {

        return $this->render('index.php', []);
    }

    public function home($t=null)
    {
        var_dump('home');
    }
}