@extends('layouts.app')

@section('title', 'Main')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/mainstyle.css') }}">
@endsection

@section('content')
    <div class="header">
        <form action="{{ route('main') }}" method="get">
            @csrf
            <a href="{{ route('main') }}">
                <img src="{{ asset('images/logo.png') }}" alt="SendSphere Logo" class="logo">
            </a>
        </form>
        <div class="nav-buttons">
            <form action="{{ route('contact.form') }}" method="get">
            @csrf
                <button type="submit" id="cont-button">Contact</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <button type="submit" id="logout-button">Log out</button>
            </form>
            <form action="{{ route('wallet') }}" method="get">
            @csrf
                <button type="submit" id="wallet-button">Wallet</button>
            </form>
            <form action="{{ route('currency.converter') }}" method="get">
            @csrf
                <button type="submit" id="currency-button">Currency Calculator</button>
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
    <script src="{{ asset('js/bannerfade.js') }}"></script>
@endsection