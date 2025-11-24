<?php

return [
    'default' => $_ENV['DB_CONNECTION'] ?? 'sqlite',
    
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => $_ENV['DATABASE_URL'] ?? '',
            'database' => $_ENV['DB_DATABASE'] ?? __DIR__ . '/../database/database.sqlite',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],
        
        'mysql' => [
            'driver' => 'mysql',
            'url' => $_ENV['DATABASE_URL'] ?? '',
            'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
            'port' => $_ENV['DB_PORT'] ?? '3306',
            'database' => $_ENV['DB_DATABASE'] ?? 'forge',
            'username' => $_ENV['DB_USERNAME'] ?? 'forge',
            'password' => $_ENV['DB_PASSWORD'] ?? '',
            'unix_socket' => $_ENV['DB_SOCKET'] ?? '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => $_ENV['MYSQL_ATTR_SSL_CA'] ?? null,
            ]) : [],
        ],
        
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => $_ENV['DATABASE_URL'] ?? '',
            'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
            'port' => $_ENV['DB_PORT'] ?? '5432',
            'database' => $_ENV['DB_DATABASE'] ?? 'forge',
            'username' => $_ENV['DB_USERNAME'] ?? 'forge',
            'password' => $_ENV['DB_PASSWORD'] ?? '',
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],
        
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => $_ENV['DATABASE_URL'] ?? '',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'port' => $_ENV['DB_PORT'] ?? '1433',
            'database' => $_ENV['DB_DATABASE'] ?? 'forge',
            'username' => $_ENV['DB_USERNAME'] ?? 'forge',
            'password' => $_ENV['DB_PASSWORD'] ?? '',
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],
    ],
];