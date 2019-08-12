<?php


namespace Rusinov\Ex2\Framework;


class ErrorHandler
{
    public static function errorHandler(int $errno , string $errstr, string $errfile, int $errline){
        _l('UnhandledError', "#{$errno} {$errstr} at {$errfile}:{$errline}");
    }

    public static function exceptionHandler($exception){
        _l('UnhandledException', throwableToString($exception), 'ALARM');
    }
}