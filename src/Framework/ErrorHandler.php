<?php


namespace Rusinov\Ex2\Framework;


use Rusinov\Ex2\LogSystem\_L;

class ErrorHandler
{
    public static function errorHandler(int $errno , string $errstr, string $errfile, int $errline){
        _L::s('UnhandledError', "#{$errno} {$errstr} at {$errfile}:{$errline}");
    }

    public static function exceptionHandler($exception){
        _L::s('UnhandledException', throwableToString($exception), 'ALARM');
    }
}