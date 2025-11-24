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

use Illuminate\Database\Schema\Blueprint;

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