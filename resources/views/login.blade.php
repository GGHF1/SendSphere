@extends('layouts.app')

@section('title', 'Login')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('main') }}" method="get">
            @csrf
            <a href="{{ route('main') }}">
                <img src="{{ asset('images/logo.png') }}" alt="SendSphere Logo" class="logo">
            </a>
        </form>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="group">
                <input type="text" name="username" id="username" placeholder="Username">
                <div class="pass-container">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <img id="togglePassword" class="eye-icon" src="{{ asset('images/view.png') }}">
                </div>
            </div>
            <button type="submit" id="log-button">Log in</button>
        </form>
        <div class="separator">
            <span>or</span>
        </div>
        <form action="{{ route('register') }}" method="get">
            @csrf
            <button type="submit" class="signup-button">Sign Up</button>
        </form>
    </div>
    <script src="{{ asset('js/showpass.js') }}"></script>
@endsection