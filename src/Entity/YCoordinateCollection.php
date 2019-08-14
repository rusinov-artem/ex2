<?php


namespace Rusinov\Ex2\Entity;


class YCoordinateCollection
{
    /**
     * @var YCoordinate[]
     */
    public $collection;

    public function __construct(array $coords)
    {
        $this->collection = $coords;
    }

    public function toYMapPoints()
    {
        $result = ['type'=>'FeatureCollection', 'features'=>[]];

        $i= 0;
        foreach ($this->collection as $coord)
        {
            $i++;
            $f = [
                'type'=>'Feature',
                'id' => $i,
                'geometry' => [
                    'type'=>'Point',
                    'coordinates'=>[
                        $coord->latitude, $coord->longitude,
                    ]
                ],
                'properties'=>[
                    'balloonContentHeader' => 'header',
                    'balloonContentBody' => 'body',
                    'balloonContentFooter' =>'footer',
                    'clusterCaption'=>'cluster caption',
                    'hintContent'=>'<strong>Текст  <s>подсказки</s></strong>'
                ]
            ];

            $result['features'][] = $f;
        }
        return json_encode($result, JSON_PRETTY_PRINT);
    }

}