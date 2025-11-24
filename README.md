# MVC Framework

This is a lightweight MVC framework inspired by Laravel, built with similar architecture and design patterns.

## Features

- MVC Architecture
- Routing system with FastRoute
- Eloquent-like ORM using Illuminate/Database
- Dependency Injection Container
- Plates templating engine
- Environment configuration with .env support
- PSR-4 autoloading
- Console command system for scaffolding and management

## Installation

1. Clone the repository
2. Run `composer install` to install dependencies
3. Copy `.env.example` to `.env` and configure your environment
4. Run the application

## Usage

The framework follows conventions:

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

### Console Commands
The framework includes a console command system accessible via the `artisan` command. Available commands include:

#### List Commands
```bash
php artisan list
```

#### Create Controllers
```bash
php artisan make:controller ControllerName
```

#### Create Models
```bash
php artisan make:model ModelName
```

#### Create Migrations
```bash
php artisan make:migration create_table_name
```

#### Run Migrations
```bash
php artisan migrate
```

#### Create Views
```bash
php artisan make:view view.name
# Creates file at app/views/view/name.php
```

#### Development Server
```bash
php artisan serve
# Starts development server on http://localhost:8000
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
│   └── Console/         # Console command system
├── database/            # Database files
├── public/              # Public web directory
├── routes/              # Route definitions
├── storage/             # Storage directory
├── vendor/              # Composer dependencies
├── .env                 # Environment variables
├── composer.json        # Project dependencies
├── artisan              # Console command entry point
└── index.php            # Application entry point
```

## Requirements

- PHP 8.1+
- Composer

## License

MIT
