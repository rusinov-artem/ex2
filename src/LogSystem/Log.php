<?php


namespace Rusinov\Ex2\LogSystem;


class Log
{
    protected $channels;

    protected $current = '';//current channel

    protected $dir = __DIR__."/../../storage/log";

    protected $path = [];

    public $handlers = [];

    public function __construct(array $channels)
    {
        $this->channels = $channels;
    }

    public function channel($name)
    {
        $this->current = $name;
        return $this;
    }

    public function send(Message $message)
    {
        if(!array_key_exists($this->current, $this->channels))
        {
            return;
        }

        if(!in_array($message->level, $this->channels[$this->current]) && !in_array('*', $this->channels[$this->current]))
        {
            return;
        }

        foreach ($this->handlers as $handler)
        {
            $handler->handle($message);
        }
    }

    public function push($item)
    {
        return array_push($this->path, $item);
    }

    public function pop()
    {
        return array_pop($this->path);
    }

    public function getPath()
    {
        return $this->path;
    }

}