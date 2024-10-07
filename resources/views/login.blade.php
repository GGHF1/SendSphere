<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="{{ route('login') }}" method="post">
        @csrf
            <div class="group">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button type="submit" id="log-button">Log in</button>
        </form>
    </div>
    <script src="{{ asset('js/logcheck.js') }}"></script>
</body>
</html>