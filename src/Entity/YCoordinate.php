<?php


namespace Rusinov\Ex2\Entity;


class YCoordinate
{
    public $id;
    public $longitude;
    public $latitude;

    public function toArray()
    {
        return [
          'id'=>$this->id,
          'longitude'=>$this->longitude,
          'latitude'=>$this->latitude,
        ];
    }
}