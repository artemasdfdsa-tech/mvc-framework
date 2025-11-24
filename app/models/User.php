<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $table = 'users';
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * Find user by email
     */
    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }
    
    /**
     * Verify password
     */
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }
}