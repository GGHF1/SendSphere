@extends('layouts.app')

@section('title', 'Currency Calculator')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/convertstyle.css') }}">
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

    <div class="container">
        <button class="quit-toggle" onclick="goBack()">
            <img src="{{ asset('images/quit.png') }}" alt="Quit">
        </button>
        <h2>Currency Calculator</h2>
        
        <form id="currency-form">
            <label for="from_currency">From:</label>
            <select id="from_currency" name="from_currency">
                @foreach ($currencies as $currency)
                    <option value="{{ $currency }}">{{ $currency }}</option>
                @endforeach
            </select>

            <label for="to_currency">To:</label>
            <select id="to_currency" name="to_currency">
                @foreach ($currencies as $currency)
                    <option value="{{ $currency }}">{{ $currency }}</option>
                @endforeach
            </select>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="1" min="1" step="any">

            <button type="submit">Convert</button>
        </form>

        <div id="conversion-result">
            <p><strong>Converted Amount:</strong> <span id="converted-amount">0</span></p>
        </div>
    </div>

    <script src="{{ asset('js/goBack.js') }}"></script>
    <script>
        document.getElementById('currency-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const fromCurrency = document.getElementById('from_currency').value;
            const toCurrency = document.getElementById('to_currency').value;
            const amount = document.getElementById('amount').value;

            fetch("{{ route('convert.currency') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    from_currency: fromCurrency,
                    to_currency: toCurrency,
                    amount: amount
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('converted-amount').textContent = `${data.convertedAmount} ${toCurrency}`;
                } else {
                    document.getElementById('converted-amount').textContent = 'Error: ' + data.message;
                }
            });
        });
    </script>
@endsection

