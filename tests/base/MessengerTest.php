<?php

namespace Rusinov\Ex2\tests\base;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class MyMessageHandler{
    public function __invoke()
    {
        $args = func_get_args();
        $a = 0;
    }
}

class MyMessage{

}

class MessengerTest extends BaseTest
{
    public function test_CanUseMessages() {
        $handler = new MyMessageHandler();

        $bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                MyMessage::class => [$handler],
            ])),
        ]);

        $msg = new MyMessage(/* ... */);

        $bus->dispatch($msg);

        $bus->dispatch(new Envelope($msg));
    }

    public function test_CanFIndConsoleCOmmands() {

    }
}