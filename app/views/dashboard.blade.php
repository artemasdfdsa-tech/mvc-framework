<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex items-center py-4">
                    <h1 class="text-xl font-semibold text-gray-800">Мое приложение</h1>
                </div>
                
                <div class="flex items-center space-x-4 py-4">
                    <span class="text-gray-700">Привет, <?php echo htmlspecialchars($user->name); ?>!</span>
                    <a href="/logout" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300">
                        Выйти
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Личный кабинет</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Информация о профиле</h3>
                    <p class="text-gray-700"><span class="font-medium">Имя:</span> <?php echo htmlspecialchars($user->name); ?></p>
                    <p class="text-gray-700"><span class="font-medium">Email:</span> <?php echo htmlspecialchars($user->email); ?></p>
                    <p class="text-gray-700"><span class="font-medium">Дата регистрации:</span> <?php echo date('d.m.Y', strtotime($user->created_at)); ?></p>
                </div>
                
                <div class="bg-green-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-800 mb-2">Статистика</h3>
                    <p class="text-gray-700">Ваша персональная информация защищена</p>
                    <p class="text-gray-700">Уровень безопасности: Высокий</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>