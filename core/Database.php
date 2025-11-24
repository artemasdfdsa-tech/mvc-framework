<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public static function boot()
    {
        $capsule = new Capsule;
        
        $capsule->addConnection([
            'driver' => 'sqlite',
            'database' => realpath($_ENV['DB_DATABASE'] ?? dirname(__DIR__, 2) . '/database/database.sqlite') ?: (substr($_ENV['DB_DATABASE'] ?? '', 0, 1) === '/' || substr($_ENV['DB_DATABASE'] ?? '', 1, 1) === ':' ? $_ENV['DB_DATABASE'] : dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . ltrim($_ENV['DB_DATABASE'] ?? '', './')),
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}