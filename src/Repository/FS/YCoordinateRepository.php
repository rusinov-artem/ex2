<?php


namespace Rusinov\Ex2\Repository\FS;


use Rusinov\Ex2\Entity\YCoordinate;
use Symfony\Component\Finder\Finder;

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

        if(empty($coord->id))
        {
            $coord->id = uniqid();
        }

        $file = "{$this->dir}/{$coord->id}";
        $r = file_put_contents($file, $str);
    }

    public function all()
    {
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->dir);

        // check if there are any search results
        if (!$finder->hasResults()) {
            return [];
        }

        $result = [];
        foreach ($finder as $file) {

            $result[$file->getFilename()] = unserialize(file_get_contents($file->getPathname()));

        }
        return $result;
    }

    public function setDir($dir){
        $this->dir = $dir;
    }
}