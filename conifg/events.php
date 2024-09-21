<?php

use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

$d = new EventDispatcher();

$d->addListener('hello', function(Event $e, $ename, $dispatcher){
    var_dump('Event Hello dispatched');
    return "RESULT";
});

return $d;
