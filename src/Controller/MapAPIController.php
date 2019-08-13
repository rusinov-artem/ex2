<?php


namespace Rusinov\Ex2\Controller;


use Rusinov\Ex2\Entity\YCoordinate;
use Rusinov\Ex2\Repository\FS\YCoordinateRepository;

class MapAPIController
{
    public function addPosition(YCoordinate $coord, YCoordinateRepository $repo)
    {
        $repo->save($coord);
    }

    public function getAll(YCoordinateRepository $repo)
    {

    }
}