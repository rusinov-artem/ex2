<?php


namespace Rusinov\Ex2\LogSystem;


interface MessageHandlerInterface
{
    public function handle(Message $m);
}