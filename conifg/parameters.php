<?php

return
[
  'development' => true,

   'channels' => [
     'system' =>['*'],
     'exception'=>['*'],
   ],

    'mysql' =>
    [
        'dbname'   => '',
        'user'     => '',
        'password' => '',
        'host'     => '',
        'driver'   => 'pdo_mysql',
    ]

];