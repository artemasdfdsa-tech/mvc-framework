<?php

namespace App\Controllers;

use Core\Controller;
use Core\Model;

class UserController extends Controller
{
    public function index()
    {
        return $this->view('users.index', [
            'title' => 'Users',
            'users' => []
        ]);
    }

    public function show($id)
    {
        return $this->view('users.show', [
            'title' => 'User Details',
            'user_id' => $id
        ]);
    }

    public function store()
    {
        $input = $_POST;
        
        return json_encode([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $input
        ]);
    }
}