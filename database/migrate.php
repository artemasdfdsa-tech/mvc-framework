<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Facade;

// Create database directory if it doesn't exist
if (!file_exists(__DIR__ . '/database.sqlite')) {
    // Create an empty SQLite file
    $dbPath = __DIR__ . '/database.sqlite';
    file_put_contents($dbPath, '');
    
    echo "Database file created at: $dbPath\n";
} else {
    echo "Database file already exists.\n";
}

// Initialize the database
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

// Set the event dispatcher used by Eloquent models
$container = new Container();
$capsule->setEventDispatcher(new Dispatcher($container));

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Bind the container to the Facade class
Facade::setFacadeApplication($container);

// Create users table if it doesn't exist
use Illuminate\Database\Schema\Blueprint;

// Check if users table exists by attempting to query it
try {
    $exists = $capsule->schema()->hasTable('users');
} catch (\Exception $e) {
    $exists = false;
}

if (!$exists) {
    $capsule->schema()->create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
    
    echo "Users table created successfully.\n";
} else {
    echo "Users table already exists.\n";
}