<?php

require_once __DIR__ . '/vendor/autoload.php';

// Simple test script to verify the framework works

echo "Testing MVC Framework Installation...\n";

// Test 1: Check if autoloader works
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

// Test 2: Check if config file exists
if (file_exists('config/database.php')) {
    echo "✓ Database config file exists\n";
} else {
    echo "✗ Database config file not found\n";
}

// Test 3: Check if .env file exists
if (file_exists('.env')) {
    echo "✓ .env file exists\n";
} else {
    echo "✗ .env file not found\n";
}

// Test 4: Check if views directory exists
if (is_dir('app/views')) {
    echo "✓ Views directory exists\n";
} else {
    echo "✗ Views directory not found\n";
}

// Test 5: Check if controllers directory exists
if (is_dir('app/controllers')) {
    echo "✓ Controllers directory exists\n";
} else {
    echo "✗ Controllers directory not found\n";
}

// Test 6: Check if models directory exists
if (is_dir('app/models')) {
    echo "✓ Models directory exists\n";
} else {
    echo "✗ Models directory not found\n";
}

echo "\nFramework structure verification complete!\n";
echo "To run the application, use: php -S localhost:8000 -t public/\n";
echo "To run migrations: php database/migrate.php\n";
echo "To see available commands: php artisan list\n";