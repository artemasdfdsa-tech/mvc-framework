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
        
        // Bind the container to the Facade class
        Facade::setFacadeApplication($this->container);
        
        // Load configuration
        $this->loadConfiguration();
        
        // Initialize database
        Database::boot();
        
        // Create router instance
        $this->router = new Router($this->container);
        
        // Make router available globally for routes file
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
        // Load environment variables
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->safeLoad();
    }

    public function run()
    {
        // Load routes
        require_once __DIR__ . '/../routes/web.php';
        
        // Dispatch the request
        $this->router->dispatch();
    }
}