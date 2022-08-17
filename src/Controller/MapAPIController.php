<?php


namespace Rusinov\Ex2\Controller;


use Rusinov\Ex2\Entity\YCoordinate;
use Rusinov\Ex2\Entity\YCoordinateCollection;
use Rusinov\Ex2\HttpApp;
use Rusinov\Ex2\Repository\FS\YCoordinateRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MapAPIController
{
    /**
     * @var HttpApp
     */
    public $app;

    public function addPosition(YCoordinate $c, YCoordinateRepository $repo, CacheInterface $cache)
    {
        $repo->save($c);
       $cache->delete('allPoints');
    }

    public function getAll(YCoordinateRepository $repo, CacheInterface $cache)
    {


        $data = $cache->get('allPoints', function(ItemInterface $item)use($repo){
            $item->expiresAfter(3600);
            $coords = $repo->all();
            $collection = new  YCoordinateCollection($coords);
            return $collection->toYMapPoints();
        } );

        header("Content-Type: text/json");
        return $data;
       // readfile(__DIR__."/../../storage/data/example.json");
        //return "LSDKFJ";
    }
}