<?php

namespace Core;

use Core\View;

class Controller
{
    protected $middleware = [];

    public function middleware($middleware, array $options = [])
    {
        $this->middleware[] = [
            'middleware' => $middleware,
            'options' => $options
        ];
        
        return $this;
    }

    protected function view($view, $data = [])
    {
        return View::make($view, $data);
    }

    protected function redirect($path)
    {
        header("Location: {$path}");
        exit();
    }
}