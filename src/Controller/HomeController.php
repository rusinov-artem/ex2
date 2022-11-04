<?php


namespace Rusinov\Ex2\Controller;


use Rusinov\Ex2\Entity\YCoordinate;
use Rusinov\Ex2\Repository\FS\YCoordinateRepository;

class HomeController extends BaseController
{

    public $layout = "layout.php";

    public function __construct()
    {

    }

    public function index(YCoordinateRepository $repo)
    {
        return $this->render('index.php', []);
    }

    public function home()
    {
        var_dump('home');
    }
}