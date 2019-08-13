<?php

namespace Rusinov\Ex2\tests\main\Repository;

use Rusinov\Ex2\Entity\YCoordinate;
use Rusinov\Ex2\Repository\FS\YCoordinateRepository;
use Rusinov\Ex2\tests\base\BaseTest;
use Symfony\Component\Filesystem\Filesystem;

class YCoordinateRepositoryTest extends BaseTest
{
    /**
     * @var YCoordinateRepository
     */
    public $repo;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCanGetRepo()
    {
        $repo = $this->app->container->get(YCoordinateRepository::class);
        $this->assertInstanceOf(YCoordinateRepository::class, $repo);
    }


    public function testAll()
    {



        /**
         * @var $repo YCoordinateRepository
         */
        $fs = new Filesystem();
        $repo = $this->app->container->get(YCoordinateRepository::class);
        $repo->dir = __DIR__."/../../storage/data/coords";
        $fs->remove($repo->dir);
        $fs->mkdir($repo->dir);
        $coords = $repo->all();
        $this->assertEmpty($coords);

        $repo->save(new YCoordinate());
        $coords = $repo->all();
        $this->assertCount(1, $coords);


        $fs->remove($repo->dir."/*");


    }
}
