<?php

namespace App\Controllers;

use Core\Controller;
use Core\Model;

class UserController extends Controller
{
    public function index()
    {
        // For now, return a simple response
        // In a real app, this would fetch users from the database
        return $this->view('users.index', [
            'title' => 'Users',
            'users' => []
        ]);
    }

    public function show($id)
    {
        // For now, return a simple response
        // In a real app, this would fetch a specific user from the database
        return $this->view('users.show', [
            'title' => 'User Details',
            'user_id' => $id
        ]);
    }

    public function store()
    {
        // For now, return a simple response
        // In a real app, this would create a new user in the database
        $input = $_POST;
        
        return json_encode([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $input
        ]);
    }
}