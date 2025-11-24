<?php
// Global helper functions

if (!function_exists('base_path')) {
    function base_path($path = '') {
        return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('config_path')) {
    function config_path($path = '') {
        return base_path('config') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('database_path')) {
    function database_path($path = '') {
        return base_path('database') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}