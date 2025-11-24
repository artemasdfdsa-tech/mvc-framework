<?php

namespace Core;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use FastRoute;

class Router
{
    protected $container;
    protected $routes = [];
    protected $dispatcher;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function get($route, $handler)
    {
        $this->addRoute('GET', $route, $handler);
        return $this;
    }

    public function post($route, $handler)
    {
        $this->addRoute('POST', $route, $handler);
        return $this;
    }

    public function put($route, $handler)
    {
        $this->addRoute('PUT', $route, $handler);
        return $this;
    }

    public function delete($route, $handler)
    {
        $this->addRoute('DELETE', $route, $handler);
        return $this;
    }

    public function addRoute($method, $route, $handler)
    {
        $this->routes[] = [$method, $route, $handler];
    }

    protected function buildDispatcher()
    {
        if ($this->dispatcher === null) {
            $this->dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
                foreach ($this->routes as $route) {
                    $r->addRoute($route[0], $route[1], $route[2]);
                }
            });
        }
        
        return $this->dispatcher;
    }

    public function dispatch()
    {
        $dispatcher = $this->buildDispatcher();
        
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                echo "404 Not Found";
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                http_response_code(405);
                echo "405 Method Not Allowed";
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                
                if (is_string($handler) && strpos($handler, '@') !== false) {
                    list($controller, $method) = explode('@', $handler);
                    $controller = "App\\Controllers\\{$controller}";
                    $controllerInstance = $this->container->make($controller);
                    $response = call_user_func_array([$controllerInstance, $method], array_values($vars));
                } elseif (is_callable($handler)) {
                    $response = call_user_func_array($handler, array_values($vars));
                }
                
                echo $response;
                break;
        }
    }
}