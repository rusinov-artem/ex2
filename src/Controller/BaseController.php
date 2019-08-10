<?php


namespace Rusinov\Ex2\Controller;


class BaseController
{
    public $layout;

    public function render($view, $data)
    {
        $view = __DIR__."/../../resource/views/$view";
        $layout = null;
        if(!empty($this->layout))
        {
            $layout = __DIR__."/../../resource/views/{$this->layout}";
        }

        $view = view($view, $data);

        if($layout)
        {
            $data['content'] = $view;
            return view($layout, $data);
        }

        return $view;



    }
}