@extends('layouts.app')

@section('title', 'Link Card')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/cardstyle.css') }}">
@endsection

@section('content')
    <div class="header">
        <form action="{{ route('main') }}" method="get">
            @csrf
            <a href="{{ route('main') }}">
                <img src="{{ asset('images/logo.png') }}" alt="SendSphere Logo" class="logo">
            </a>
        </form>
    </div>

    <form action="{{ route('add.card') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="visa-card">
            <div class="logoContainer">
                <img class="svgLogo" src="{{ asset ('images/Visa-Mastercard.png') }}">
            </div>
            <div class="number-container">
                <label class="input-label" for="card_number">CARD NUMBER</label>
                <input class="inputstyle" id="card_number" placeholder="XXXX XXXX XXXX XXXX" name="card_number" type="text" maxlength="16" />
            </div>

            <div class="name-date-cvv-container">
                <div class="name-wrapper">
                    <label class="input-label" for="cardholder_name">CARD HOLDER</label>
                    <input class="inputstyle" id="cardholder_name" name="cardholder_name" placeholder="NAME" type="text" />
                </div>

                <div class="expiry-wrapper">
                    <label class="input-label" for="expiry_date">VALID THRU</label>
                    <input class="inputstyle" id="expiry_date" name="expiry_date" placeholder="MM/YY" type="text" maxlength="5" />
                </div>
                <div class="cvv-wrapper">
                    <label class="input-label" for="cvv">CVV</label>
                    <input class="inputstyle" id="cvv" name="cvv" placeholder="***" maxlength="3" type="password" />
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif    
        <button type="submit" class="submit-button">Add Card</button>
    </form>

    <script>
        document.getElementById('expiry_date').addEventListener('input', function(e) {
            var input = e.target.value;
            if (input.length === 2 && !input.includes('/')) {
                e.target.value = input + '/';
            }
        });
    </script>

@endsection