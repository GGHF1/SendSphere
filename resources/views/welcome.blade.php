<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SendSphere</title>
    <link rel="stylesheet" href="{{ asset('css/welcomestyle.css') }}">
</head>
<body>

    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="SendSphere Logo" class="logo">
        <div class="nav-buttons">
            <button type="submit" id="cont-button">Contact</button>
            <form action="{{ route('login') }}" method="get">
                <button type="submit" id="log-button">Log in</button>
            </form>
            <form action="{{ route('register') }}" method="get">
                <button type="submit" id="reg-button">Sign Up</button>
            </form>
        </div>
    </div>

    <div class="img-banner">
        <img src="{{ asset('images/img-banner.jpg') }}">
        <div>
            <h2>We’ve got you covered.</h2>
            <p>
                Send money easily from your SendSphere wallet to others. 
                Shop with peace of mind, we protect your eligible transactions.
            </p>
        </div>
    </div>

    <div class="ad-space"></div>

</body>
</html>
