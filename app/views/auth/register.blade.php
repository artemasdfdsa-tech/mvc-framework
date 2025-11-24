@extends('layouts.app')

@section('content')
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Регистрация</h2>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="/register">
            <div class="mb-4">
                <label for="name" class="block text-gray-70 text-sm font-bold mb-2">Имя:</label>
                <input type="text" id="name" name="name" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Пароль:</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button type="submit" 
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                Зарегистрироваться
            </button>
        </form>
        
        <div class="mt-4 text-center">
            <p class="text-gray-600">
                Уже есть аккаунт? 
                <a href="/login" class="text-blue-600 hover:text-blue-800 font-medium">Войти</a>
            </p>
        </div>
@endsection