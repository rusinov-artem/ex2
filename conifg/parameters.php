<?php

return
[
  'development' => false,

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