<?php


namespace Rusinov\Ex2\LogSystem;


class FileHandler implements MessageHandlerInterface
{
    public $dir = __DIR__."/../../storage/log";

    public $withSourceLine = true;
    public $withPath = true;

    public function handle(Message $m)
    {
        $str = "[{$m->time}] [{$m->channel}] [{$m->level}] [{$m->message}]\n";

        if($this->withPath && !empty($m->path) )
        {
            $str .= "\tPath: ".implode(" -> ", $m->path)."\n";
        }

        if($this->withSourceLine)
            $str .= "\t{$m->sourceFile}:{$m->sourceLine} \n";

        $r = @file_put_contents("{$this->dir}/{$m->channel}.log", $str, FILE_APPEND);

    }

}