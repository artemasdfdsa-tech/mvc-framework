<?php

namespace Core;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        // Set the connection from config
        $this->connection = $_ENV['DB_CONNECTION'] ?? 'sqlite';
    }
}