<?php


namespace Rusinov\Ex2\LogSystem;


class Message
{
    public $time;
    public $path = [];
    public $level;
    public $channel;
    public $message;
    public $sourceFile;
    public $sourceLine;

    public function __construct()
    {
        $this->time = dt();
    }
}