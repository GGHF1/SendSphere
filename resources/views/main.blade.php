<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icons.png') }}" >
    <link rel="stylesheet" href="{{ asset('css/mainstyle.css') }}">
    <title>Main</title>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="SendSphere Logo" class="logo">
        <div class="nav-buttons">
            <form action="{{ route('contact.form') }}" method="get">
            @csrf
                <button type="submit" id="cont-button">Contact</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <button type="submit" id="logout-button">Logout</button>
            </form>
            <button type="submit" id="wallet-button">Wallet</button>
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
    <script src="{{ asset('js/bannerfade.js') }}"></script>
</body>
</html>