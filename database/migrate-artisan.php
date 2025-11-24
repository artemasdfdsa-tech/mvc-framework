<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Facade;

if (!file_exists(__DIR__ . '/database.sqlite')) {
    $dbPath = __DIR__ . '/database.sqlite';
    file_put_contents($dbPath, '');
    
    echo "Database file created at: $dbPath\n";
} else {
    echo "Database file already exists.\n";
}
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => $_ENV['DB_DRIVER'] ?? 'sqlite',
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'database' => $_ENV['DB_DATABASE'] ?? __DIR__ . '/database.sqlite',
    'username' => $_ENV['DB_USERNAME'] ?? 'root',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
    'foreign_key_constraints' => true,
]);

$container = new Container();
$capsule->setEventDispatcher(new Dispatcher($container));

$capsule->setAsGlobal();
$capsule->bootEloquent();

Facade::setFacadeApplication($container);

$migrationsPath = __DIR__ . '/migrations';

$fresh = in_array('--fresh', $argv ?? []);
$rollback = in_array('--rollback', $argv ?? []);

if ($fresh) {
    echo "Dropping all tables...\n";
    
    $tables = [];
    try {
        if ($_ENV['DB_DRIVER'] ?? 'sqlite' === 'sqlite') {
            $stmt = $capsule->getConnection()->getPdo()->query("SELECT name FROM sqlite_master WHERE type='table'");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        } else {
            $stmt = $capsule->getConnection()->getPdo()->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
    } catch (\Exception $e) {
        echo "Could not retrieve table list: " . $e->getMessage() . "\n";
    }

    $tables = array_filter($tables, function($table) {
        return !in_array($table, ['migrations', 'sqlite_sequence']);
    });

    foreach ($tables as $table) {
        $capsule->schema()->dropIfExists($table);
        echo "Dropped table: $table\n";
    }

    echo "All tables dropped. Now running all migrations...\n";
}

if ($rollback && !$fresh) {
    $migrationFiles = glob($migrationsPath . '/*.php');
    rsort($migrationFiles);

    foreach ($migrationFiles as $migrationFile) {
        $migration = require $migrationFile;
        $fileName = basename($migrationFile);
        
        if (isset($migration['down'])) {
            try {
                $tableName = preg_replace('/^.*create_(.*)_table.*$/', '$1', $fileName);
                $tableExists = $capsule->schema()->hasTable($tableName);
            } catch (\Exception $e) {
                $tableExists = false;
            }

            if ($tableExists) {
                $migration['down']($capsule);
                echo "Migration rolled back: $fileName\n";
            } else {
                echo "Migration already rolled back: $fileName\n";
            }
        }
    }
} elseif (is_dir($migrationsPath)) {
    $migrationFiles = glob($migrationsPath . '/*.php');
    sort($migrationFiles);

    foreach ($migrationFiles as $migrationFile) {
        $migration = require $migrationFile;
        $fileName = basename($migrationFile);
        
        if (isset($migration['up'])) {
            try {
                $tableName = preg_replace('/^.*create_(.*)_table.*$/', '$1', $fileName);
                $tableExists = $capsule->schema()->hasTable($tableName);
            } catch (\Exception $e) {
                $tableExists = false;
            }

            if (!$tableExists) {
                $migration['up']($capsule);
                echo "Migration executed: $fileName\n";
            } else {
                echo "Migration already exists: $fileName\n";
            }
        }
    }
} else {
    echo "No migrations directory found.\n";
}