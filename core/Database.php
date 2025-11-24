<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public static function boot()
    {
        $capsule = new Capsule;
        
        $capsule->addConnection([
            'driver' => $_ENV['DB_DRIVER'] ?? 'sqlite',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'database' => $_ENV['DB_DATABASE'] ?? __DIR__ . '/../../database/database.sqlite',
            'username' => $_ENV['DB_USERNAME'] ?? 'root',
            'password' => $_ENV['DB_PASSWORD'] ?? '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}