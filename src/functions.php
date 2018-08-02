<?php

function view($view, $data)
{
    extract($data);
    ob_start();
        include $view;
    return ob_get_clean();
}