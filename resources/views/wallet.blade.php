@extends('layouts.app')

@section('title', 'Wallet')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/walletstyle.css') }}">
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
        </div>
    </div>

    <div class="container">
        <div class="wallet-sidebar">
            <form action="{{ route('link.card') }}" method="get">
            @csrf
                <button class="link-button">Link a card</button>
            </form>
            <div class="card-info">
                @php
                    // Separate preferred card from the rest
                    $preferredCard = $cards->where('preferred', true)->first();
                    $otherCards = $cards->where('preferred', false);
                @endphp

                {{-- Display preferred card first --}}
                @if ($preferredCard)
                    <div class="card-container preferred">
                        <p>Credit ••{{ substr($preferredCard->card_number, -4) }}</p>
                        <p>Expiry: {{ \Carbon\Carbon::parse($preferredCard->expiry_date)->format('m/y') }}</p>
                        <span class="preferred-tag">PREFERRED</span>
                    </div>
                @endif

                {{-- Display other cards below --}}
                @foreach ($otherCards as $card)
                    <div class="card-container">
                        <p>Credit ••{{ substr($card->card_number, -4) }}</p>
                        <p>Expiry: {{ \Carbon\Carbon::parse($card->expiry_date)->format('m/y') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="wallet-main">
            <h2>SendSphere Balance</h2>
            <p class="currency-amount">{{ $currency }} {{ $balance }},00</p>
            <button class="transfer-button">Transfer Money</button>
            <div class="currency-section">
                <a href="{{ route('currency.converter') }}" class="currency-calculator">Currency Converter</a>
            </div>
        </div>
    </div>
@endsection