<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icons.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')
    <title>@yield('title', 'SendSphere')</title>
</head>
<body>
    <div class="page-container">
        <div class="main-container">
            @yield('content')
        </div>
        <footer class="footer">
            <p>&copy;2024-2025 SendSphere <a href="{{ route('contact.form') }}" id="cont-button">Contact us</a></p>
        </footer>
    </div>
</body>
</html>
