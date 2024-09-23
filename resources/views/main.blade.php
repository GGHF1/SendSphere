<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/mainstyle.css') }}">
    <title>Main</title>
</head>
<body>
    <div class="container">
        <h1>Main</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" id="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>