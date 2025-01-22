<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    public function walletInfo()
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        $currency = $wallet->currency;
        $balance = $wallet->balance;

        return view('wallet', ['balance' => $balance, 'currency' => $currency]);
    }

    public function currencyConverter()
    {
        // Retrieve the list of currencies from the ECB XML feed (or a local file/database)
        $currencies = $this->getCurrencies(); // Method to fetch the list of currencies
        return view('currency_converter', compact('currencies'));
    }

    public function convertCurrency(Request $request)
    {
        $fromCurrency = $request->input('from_currency');
        $toCurrency = $request->input('to_currency');
        $amount = $request->input('amount');

        // Fetch exchange rates from XML
        $rate = $this->getExchangeRate($fromCurrency, $toCurrency);

        // Calculate the converted amount
        if ($rate) {
            $convertedAmount = $amount * $rate;
            return response()->json([
                'success' => true,
                'convertedAmount' => number_format($convertedAmount, 2),
                'rate' => $rate,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Conversion failed.']);
    }

    public function getCurrencies()
    {
        $xmlUrl = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
        $response = Http::get($xmlUrl);

        if ($response->ok()) {
            $xml = simplexml_load_string($response->body());
            $currencies = ['EUR']; // base currency. its not in the xml list. default = 1
            foreach ($xml->Cube->Cube->Cube as $rate) {
                $currencies[] = (string) $rate['currency'];
            }
            return $currencies;
        }

        return [];
    }

    // Fetch the exchange rate between two currencies
    public function getExchangeRate($fromCurrency, $toCurrency)
    {
        if ($fromCurrency === $toCurrency) {
            return 1.0; // No conversion needed if both currencies are the same
        }

        $xmlUrl = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
        $response = Http::get($xmlUrl);

        if ($response->ok()) {
            $xml = simplexml_load_string($response->body());
            $rates = [];

            foreach ($xml->Cube->Cube->Cube as $rate) {
                $currency = (string) $rate['currency'];
                $value = (float) $rate['rate'];
                $rates[$currency] = $value;
            }

            // Handle EUR explicitly since it is the base currency
            if ($fromCurrency === 'EUR') {
                return $rates[$toCurrency] ?? null;
            } elseif ($toCurrency === 'EUR') {
                return 1 / ($rates[$fromCurrency] ?? 1);
            }

            // Convert from one currency to another via EUR as the base
            $fromRate = $rates[$fromCurrency] ?? 1;
            $toRate = $rates[$toCurrency] ?? 1;
            return $toRate / $fromRate;
        }

        return null;
    }

}

