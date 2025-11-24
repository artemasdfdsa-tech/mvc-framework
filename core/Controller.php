<?php

namespace Core;

use Core\View;
use Core\Cookie;

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

    public function __get($name)
    {
        if ($name === 'cookie') {
            return new class() {
                public function set($name, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false) {
                    return Cookie::set($name, $value, $expire, $path, $domain, $secure, $httponly);
                }

                public function get($name, $default = null) {
                    return Cookie::get($name, $default);
                }

                public function has($name) {
                    return Cookie::has($name);
                }

                public function delete($name, $path = '/', $domain = '') {
                    return Cookie::delete($name, $path, $domain);
                }

                public function setSession($name, $value, $path = '/', $domain = '', $secure = false, $httponly = false) {
                    return Cookie::setSession($name, $value, $path, $domain, $secure, $httponly);
                }
            };
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );
        return null;
    }
}