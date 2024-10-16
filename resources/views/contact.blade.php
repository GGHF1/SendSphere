<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/icons.png') }}" >
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('css/contactstyle.css') }}">
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form action="{{ route('contact.send') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="{{ Auth::check() ? Auth::user()->fname : '' }}" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="{{ Auth::check() ? Auth::user()->lname : '' }}" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" rows="5" required></textarea>
            </div>
            <button type="submit">Ask the Question</button>
        </form> 
    </div>
</body>
</html>