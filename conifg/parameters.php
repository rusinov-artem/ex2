<?php

return
[
  'development' => true,

   'channels' => [
//     'system' =>['*'],
//     'exception'=>['*'],
//     'UnhandledException'=>['*'],
//     'UnhandledError' => ['*'],
   ],

    'mysql' =>
    [
        'dbname'   => '',
        'user'     => '',
        'password' => '',
        'host'     => '',
        'driver'   => 'pdo_mysql',
    ],

    'YCoordinateRepository'=>
    [
        'dir' => __DIR__."/../storage/data/coords"
    ],

    'cache'=>
    [
        'dir' => __DIR__."/../storage/cache/main",
    ],

];