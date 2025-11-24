<?php

namespace Core;

class Config
{
    private static $config = [];

    public static function load($configName)
    {
        if (!isset(self::$config[$configName])) {
            $configFile = __DIR__ . "/../config/{$configName}.php";
            
            if (file_exists($configFile)) {
                self::$config[$configName] = require $configFile;
            } else {
                self::$config[$configName] = [];
            }
        }
        
        return self::$config[$configName];
    }

    public static function get($key, $default = null)
    {
        $parts = explode('.', $key);
        $configName = array_shift($parts);
        
        $config = self::load($configName);
        
        foreach ($parts as $part) {
            if (is_array($config) && isset($config[$part])) {
                $config = $config[$part];
            } else {
                return $default;
            }
        }
        
        return $config;
    }

    public static function set($key, $value)
    {
        $parts = explode('.', $key);
        $configName = array_shift($parts);
        
        if (!isset(self::$config[$configName])) {
            self::load($configName);
        }
        
        $config = &self::$config[$configName];
        
        $lastKey = array_pop($parts);
        
        foreach ($parts as $part) {
            if (!isset($config[$part]) || !is_array($config[$part])) {
                $config[$part] = [];
            }
            $config = &$config[$part];
        }
        
        $config[$lastKey] = $value;
    }
}