# Laravel-like MVC Framework

This is a lightweight MVC framework inspired by Laravel, built with similar architecture and design patterns.

## Features

- MVC Architecture
- Routing system with FastRoute
- Eloquent-like ORM using Illuminate/Database
- Dependency Injection Container
- Plates templating engine
- Environment configuration with .env support
- PSR-4 autoloading

## Installation

1. Clone the repository
2. Run `composer install` to install dependencies
3. Copy `.env.example` to `.env` and configure your environment
4. Run the application

## Usage

The framework follows Laravel-like conventions:

### Routing
Routes are defined in `routes/web.php`:
```php
$router->get('/', function() {
    return 'Hello World!';
});

$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
```

### Controllers
Controllers extend the base `Core\Controller` class:
```php
<?php

namespace App\Controllers;

use Core\Controller;

class UserController extends Controller
{
    public function index()
    {
        return $this->view('users.index', ['users' => []]);
    }
}
```

### Models
Models extend the base `Core\Model` class which uses Eloquent:
```php
<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];
}
```

## Directory Structure

```
mvc-laravel-like/
├── app/
│   ├── controllers/     # Controller classes
│   ├── models/          # Model classes
│   └── views/           # View templates
├── config/              # Configuration files
├── core/                # Core framework classes
├── database/            # Database files
├── public/              # Public web directory
├── routes/              # Route definitions
├── storage/             # Storage directory
├── vendor/              # Composer dependencies
├── .env                 # Environment variables
├── composer.json        # Project dependencies
└── index.php            # Application entry point
```

## Requirements

- PHP 8.1+
- Composer

## License

MIT
