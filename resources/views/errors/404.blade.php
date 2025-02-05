@extends('layouts.app')

@section('title', 'Page Not Found')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/404style.css') }}">
@endsection

@section('content')
<body>
    <div class="container">
        <h1>404</h1>
        <p class="message">Oops! The page you're looking for doesn't exist.</p>
        <a href="/">Go Back to Home</a>
    </div>
</body>
</html>
@endsection