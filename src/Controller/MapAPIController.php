<?php


namespace Rusinov\Ex2\Controller;


use Rusinov\Ex2\Entity\YCoordinate;
use Rusinov\Ex2\Entity\YCoordinateCollection;
use Rusinov\Ex2\Repository\FS\YCoordinateRepository;

class MapAPIController
{
    public function addPosition(YCoordinate $c, YCoordinateRepository $repo)
    {
        $repo->save($c);
    }

    public function getAll(YCoordinateRepository $repo)
    {
        $coords = $repo->all();
        $collection = new  YCoordinateCollection($coords);
        header("Content-Type: text/json");
        return $collection->toYMapPoints();
        //readfile(__DIR__."/../../storage/data/example.json");
    }
}