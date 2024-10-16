<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your message is submitted</title>
    <link rel="icon" href="{{ asset('images/icons.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/404style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Thank You!</h1>
        <p class="message">Your message is submitted. It will be reviewed shortly</p>
        @if (Auth::check())
            <a href="{{ route('main') }}">Go Back to Home</a>
        @else
            <a href="{{ route('welcome') }}">Go Back to Home</a>
        @endif
    </div>
</body>
</html>
