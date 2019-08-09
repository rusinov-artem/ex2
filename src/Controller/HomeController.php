<?php


namespace Rusinov\Ex2\Controller;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Rusinov\Ex2\Services\Service1;

class HomeController extends BaseController
{

    public function __construct()
    {

    }

    public function index(Connection $db)
    {
        $stm =$db->query("show tables");
        $stm->execute();
        while($row = $stm->fetch(\PDO::FETCH_ASSOC))
        {
            var_dump($row);
        }

        return $this->render('index.php', []);
    }

    public function home($t=null)
    {
        var_dump('home');
    }
}