<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MVC Framework')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .header { background: #f4f4f4; padding: 20px; margin-bottom: 20px; }
        .content { margin: 20px 0; }
        .footer { background: #f4f4f4; padding: 20px; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>@yield('title', 'MVC Framework')</h1>
    </div>
    
    <div class="content">
        @yield('content')
    </div>
    
    <div class="footer">
        <p>&copy; 2025 MVC Framework</p>
    </div>
</body>
</html>