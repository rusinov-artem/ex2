<?php

use Rusinov\Ex2\LogSystem\_L;

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
    return $t->getMessage().' code='.$t->getCode().' '.$t->getFile().':'.$t->getLine();
}
