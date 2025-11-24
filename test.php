<?php

require_once __DIR__ . '/vendor/autoload.php';

echo "Testing MVC Framework Installation...\n";
if (class_exists('Core\Application')) {
    echo "✓ Application class loaded successfully\n";
} else {
    echo "✗ Application class not found\n";
}

if (class_exists('Core\Controller')) {
    echo "✓ Controller class loaded successfully\n";
} else {
    echo "✗ Controller class not found\n";
}

if (class_exists('Core\Model')) {
    echo "✓ Model class loaded successfully\n";
} else {
    echo "✗ Model class not found\n";
}

if (class_exists('Core\Router')) {
    echo "✓ Router class loaded successfully\n";
} else {
    echo "✗ Router class not found\n";
}

if (file_exists('config/database.php')) {
    echo "✓ Database config file exists\n";
} else {
    echo "✗ Database config file not found\n";
}

if (file_exists('.env')) {
    echo "✓ .env file exists\n";
} else {
    echo "✗ .env file not found\n";
}

if (is_dir('app/views')) {
    echo "✓ Views directory exists\n";
} else {
    echo "✗ Views directory not found\n";
}

if (is_dir('app/controllers')) {
    echo "✓ Controllers directory exists\n";
} else {
    echo "✗ Controllers directory not found\n";
}

if (is_dir('app/models')) {
    echo "✓ Models directory exists\n";
} else {
    echo "✗ Models directory not found\n";
}

echo "\nFramework structure verification complete!\n";
echo "To run the application, use: php -S localhost:8000 -t public/\n";
echo "To run migrations: php database/migrate.php\n";
echo "To see available commands: php artisan list\n";