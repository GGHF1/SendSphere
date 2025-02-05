@extends('layouts.app')

@section('title', 'Your message is submitted')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/404style.css') }}">
@endsection

@section('content')
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
@endsection
