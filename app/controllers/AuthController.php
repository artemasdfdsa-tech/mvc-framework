<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use Core\Database;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        return $this->view('auth.register');
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $name = $request->input('name', '');
        $email = $request->input('email', '');
        $password = $request->input('password', '');

        // Validate input
        if (empty($name) || empty($email) || empty($password)) {
            return $this->view('auth.register', [
                'error' => 'Все поля обязательны для заполнения'
            ]);
        }

        // Check if user already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            return $this->view('auth.register', [
                'error' => 'Пользователь с таким email уже существует'
            ]);
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create new user
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $hashedPassword;
        
        if ($user->save()) {
            // Set session cookie
            $this->cookie->set('user_id', $user->id, time() + (86400 * 30), '/'); // 30 days
            
            return $this->redirect('/dashboard');
        } else {
            return $this->view('auth.register', [
                'error' => 'Ошибка при регистрации'
            ]);
        }
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return $this->view('auth.login');
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $email = $request->input('email', '');
        $password = $request->input('password', '');

        // Validate input
        if (empty($email) || empty($password)) {
            return $this->view('auth.login', [
                'error' => 'Email и пароль обязательны для заполнения'
            ]);
        }

        // Find user by email
        $user = User::findByEmail($email);
        
        if ($user && $user->verifyPassword($password)) {
            // Set session cookie
            $this->cookie->set('user_id', $user->id, time() + (86400 * 30), '/'); // 30 days
            
            return $this->redirect('/dashboard');
        } else {
            return $this->view('auth.login', [
                'error' => 'Неверный email или пароль'
            ]);
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $this->cookie->delete('user_id');
        return $this->redirect('/index');
    }

    /**
     * Show dashboard (protected route)
     */
    public function dashboard()
    {
        $userId = $this->cookie->get('user_id');
        
        if (!$userId) {
            return $this->redirect('/login');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return $this->redirect('/login');
        }

        return $this->view('dashboard', [
            'user' => $user
        ]);
    }

}
