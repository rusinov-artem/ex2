<?php


namespace Rusinov\Ex2\LogSystem;


use Rusinov\Ex2\Framework\Facade;

class _L extends Facade
{
    /**
     * @var Log
     */
    protected static $instance = null;

    protected static function getInstance()
    {
        if(!static::$instance)
        {
            $params = include __DIR__."/../../conifg/logger.php";
            static::$instance =  new Log($params['channels']);
            static::$instance->handlers[] = new FileHandler();
        }

        return static::$instance;
    }

    public static function s($channel, $message, $level = 'INFO')
    {
        $instance = static::getInstance();
        $bt = debug_backtrace();
        $caller = array_shift($bt);

        $m = new Message();
        $m->sourceFile = $caller['file'];
        $m->sourceLine = $caller['line'];
        $m->channel = $channel;
        $m->level = $level;
        $m->message = $message;
        $m->path = $instance->getPath();

        $instance->channel($channel)->send($m);
    }

}