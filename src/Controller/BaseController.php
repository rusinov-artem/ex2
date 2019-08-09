<?php


namespace Rusinov\Ex2\Controller;


class BaseController
{
    public function render($view, $data)
    {
        $view = __DIR__."/../../resource/views/$view";
        return view($view, $data);
    }
}