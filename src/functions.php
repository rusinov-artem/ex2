<?php

function view($view, $data)
{
    extract($data);
    ob_start();
        include $view;
    return ob_get_clean();
}

function dt()
{
    return (new \DateTime())->format("Y-m-d H:i:s");
}

function throwableToString(\Throwable $t)
{
    return $t->getMessage().' ['.$t->getCode().'] '.$t->getFile().':'.$t->getLine();
}

function _l($channel, $message, $level = 'INFO')
{
    global $logger, $params;
    if(!$logger)
    {
        $logger = new Rusinov\Ex2\LogSystem\Log($params['channels']);
    }

    $logger->channel($channel)->send($message, $level);
}