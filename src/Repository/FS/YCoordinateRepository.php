<?php


namespace Rusinov\Ex2\Repository\FS;


use Rusinov\Ex2\Entity\YCoordinate;

class YCoordinateRepository
{
    /**
     * Path to data dir
     * @var string
     */
    public $dir;

    public function save(YCoordinate $coord)
    {
        $str = serialize($coord);
        file_put_contents("{$dir}/{$coord->id}", $str);
    }

    public function all()
    {

    }
}