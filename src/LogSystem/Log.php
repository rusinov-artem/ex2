<?php


namespace Rusinov\Ex2\LogSystem;


class Log
{
    private $channels;
    private $current = '';
    private $dir = __DIR__."/../../storage/log";

    public function __construct(array $channels)
    {
        $this->channels = $channels;
    }

    public function channel($name)
    {
        $this->current = $name;
        return $this;
    }

    public function send($message, $level = "INFO")
    {
        if(!array_key_exists($this->current, $this->channels))
        {
            return;
        }

        if(!in_array($level, $this->channels[$this->current]) && !in_array('*', $this->channels[$this->current]))
        {
            return;
        }

        $dt = dt();
        $data = "[{$dt}] [$level] [$message]\n";

        file_put_contents("{$this->dir}/{$this->current}.log", $data, 8);
    }
}