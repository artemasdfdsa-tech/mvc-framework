<?php

namespace Core;

use Illuminate\View\Factory;
use Illuminate\View\ViewFinderInterface;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class View
{
    private static $factory;

    public static function init()
    {
        if (self::$factory === null) {
            $container = new Container();
            
            // Set up the engine resolver
            $resolver = new EngineResolver();
            
            // Register the PHP engine
            $resolver->register('php', function () {
                return new PhpEngine();
            });
            
            // Register the Blade engine
            $bladeCompiler = new BladeCompiler(
                new \Illuminate\Filesystem\Filesystem(),
                __DIR__ . '/../storage/views'
            );
            
            $resolver->register('blade', function () use ($bladeCompiler) {
                return new CompilerEngine($bladeCompiler);
            });
            
            // Set up the view finder
            $finder = new class implements ViewFinderInterface {
                protected $paths = [];
                protected $hints = [];
                protected $extensions = ['blade.php', 'php'];

                public function __construct() {
                    $this->paths = [__DIR__ . '/../app/views'];
                }
                
                public function find($view) {
                    $view = str_replace('.', '/', $view);
                    
                    foreach ($this->paths as $path) {
                        foreach ($this->extensions as $extension) {
                            $fullPath = $path . '/' . $view . '.' . $extension;
                            if (file_exists($fullPath)) {
                                return $fullPath;
                            }
                        }
                    }
                    
                    throw new \InvalidArgumentException("View [{$view}] not found.");
                }
                
                public function addExtension($extension) {
                    if (($index = array_search($extension, $this->extensions)) !== false) {
                        unset($this->extensions[$index]);
                    }
                    array_unshift($this->extensions, $extension);
                }
                
                public function addNamespace($namespace, $hints) {
                    $hints = (array) $hints;
                    
                    if (isset($this->hints[$namespace])) {
                        $hints = array_merge($this->hints[$namespace], $hints);
                    }
                    
                    $this->hints[$namespace] = $hints;
                }
                
                public function getFilesystem() {
                    return new \Illuminate\Filesystem\Filesystem();
                }
                
                public function getHints() {
                    return $this->hints;
                }
                
                public function getPaths() {
                    return $this->paths;
                }
                
                public function addLocation($location) {
                    $this->paths[] = $location;
                }
                
                public function flush() {
                    // For simple implementation, we don't cache, so nothing to flush
                }
                
                public function prependNamespace($namespace, $hints) {
                    $hints = (array) $hints;
                    
                    if (isset($this->hints[$namespace])) {
                        $hints = array_merge($hints, $this->hints[$namespace]);
                    }
                    
                    $this->hints[$namespace] = $hints;
                }
                
                public function replaceNamespace($namespace, $hints) {
                    $this->hints[$namespace] = (array) $hints;
                }
            };
            
            // Create the event dispatcher
            $events = new Dispatcher($container);
            
            // Create the view factory
            self::$factory = new Factory($resolver, $finder, $events);
        }
    }

    public static function make($template, $data = [])
    {
        self::init();
        return self::$factory->make($template, $data)->render();
    }
    
    public static function share($key, $value = null)
    {
        self::init();
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                self::$factory->share($k, $v);
            }
        } else {
            self::$factory->share($key, $value);
        }
    }
}