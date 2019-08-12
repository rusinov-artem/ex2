<?php

return
[
  'development' => true,

   'channels' => [
     'system' =>['*'],
     'exception'=>['*'],
     'UnhandledException'=>['*'],
     'UnhandledError' => ['*'],
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