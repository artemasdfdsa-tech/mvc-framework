<?php

namespace Core;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Facade;
use Core\Router;
use Core\Database;
use Core\Config;

class Application
{
    protected $container;
    protected $router;
    protected $dispatcher;

    public function __construct()
    {
        $this->container = new Container();
        $this->dispatcher = new Dispatcher($this->container);
        
        Facade::setFacadeApplication($this->container);
        $this->loadConfiguration();
        Database::boot();
        $this->router = new Router($this->container);
        $GLOBALS['app'] = $this;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function getRouter()
    {
        return $this->router;
    }

    protected function loadConfiguration()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->safeLoad();
    }

    public function run()
    {
        require_once __DIR__ . '/../routes/web.php';
        $this->router->dispatch();
    }
}