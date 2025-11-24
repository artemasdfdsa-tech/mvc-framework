<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\View;

// Test if the view system works
try {
    $output = View::make('users.index', [
        'title' => 'Test Users Page',
        'users' => [
            (object)['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            (object)['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com']
        ]
    ]);
    
    echo "View rendered successfully!\n";
    echo "Output length: " . strlen($output) . " characters\n";
    echo "First 100 chars: " . substr($output, 0, 100) . "...\n";
} catch (Exception $e) {
    echo "Error rendering view: " . $e->getMessage() . "\n";
}