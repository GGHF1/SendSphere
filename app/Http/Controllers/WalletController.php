<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Wallet; 

class WalletController extends Controller
{
    public function walletInfo()
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        $currency = $wallet->currency;
        $balance = $wallet->balance;
        $cards = $wallet->cards;

        return view('wallet', ['balance' => $balance, 'currency' => $currency, 'cards' => $cards]);
    }

    public function currencyConverter()
    {
        // Retrieve the list of currencies from the ECB XML feed (or a local file/database)
        $currencies = $this->getCurrencies(); // Method to fetch the list of currencies
        return view('currency_converter', compact('currencies'));
    }

    public function convertCurrency(Request $request)
    {
        $request->validate([
            'from_currency' => 'required|in:EUR',
            'to_currency' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);
    
        $fromCurrency = $request->input('from_currency');
        $toCurrency = $request->input('to_currency');
        $amount = $request->input('amount');
    
        // avg fees for currencies
        $conversionFees = [
            'USD' => 2.23460566,
            'JPY' => 2.530217,
            'BGN' => 2.99804115,
            'CZK' => 2.80635794,
            'DKK' => 2.99111872,
            'GBP' => 2.61041807,
            'HUF' => 1.94067075,
            'PLN' => 2.55191251,
            'RON' => 2.07813239,
            'SEK' => 2.9134697,
            'CHF' => 2.58770923,
            'ISK' => 2.32844,
            'NOK' => 2.45351547,
            'TRY' => 2.22888174,
            'AUD' => 2.77914555,
            'BRL' => 1.95475703,
            'CAD' => 2.44722733,
            'CNY' => 2.10510088,
            'HKD' => 2.24788401,
            'IDR' => 2.74876137,
            'ILS' => 1.7401828,
            'INR' => 2.1915015,
            'KRW' => 2.4329438,
            'MXN' => 2.73522933,
            'MYR' => 1.93399347,
            'NZD' => 2.13419261,
            'PHP' => 2.119556,
            'SGD' => 2.06059674,
            'THB' => 1.85886918,
            'ZAR' => 1.78701102,
        ];
    
        $rate = $this->getExchangeRate($fromCurrency, $toCurrency);
    
        if ($rate) {
            $convertedAmount = $amount * $rate;
            $conversionFeePercentage = $conversionFees[$toCurrency] ?? 0; // 0 if currency not found
            $feeAmount = $convertedAmount * ($conversionFeePercentage / 100);
            $finalAmount = $convertedAmount + $feeAmount;
            
            return response()->json([
                'success' => true,
                'convertedAmount' => number_format($finalAmount, 2),
                'originalAmount' => number_format($convertedAmount, 2),
                'rate' => $rate,
                'feePercentage' => $conversionFeePercentage,
                'feeAmount' => number_format($feeAmount, 2),
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

    public function getExchangeRate($fromCurrency, $toCurrency)
    {
        if ($fromCurrency !== 'EUR') {
            return null; // Only conversions from EUR
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

            return $rates[$toCurrency] ?? null;
        }

        return null;
    }

    public function linkCardForm()
    {
        return view('link_card');
    }

    public function addcard(Request $request)
    {
        
        $request->validate([
            'card_number' => 'required|numeric|digits:16',
            'expiry_date' => 'required|date_format:m/y|after:today',
            'cardholder_name' => 'required|string',
            'cvv' => 'required|numeric|digits:3',
        ]);

        $user = Auth::user();
        $wallet = $user->wallet;
        $cardType = null; 

        if (!$wallet) {
            return redirect()->back()->with('error', 'No wallet found for this user.');
        }

        $cardNumber = $request->card_number;
        if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $cardNumber)) {
            $cardType = 'Visa';
        } elseif (preg_match('/^5[1-5][0-9]{14}$/', $cardNumber) || preg_match('/^2(22[1-9]|2[3-9][0-9]|[3-6][0-9]{2}|7([01][0-9]|20))[0-9]{12}$/', $cardNumber)) {
            $cardType = 'MasterCard';
        } else {
            return redirect()->back()->with('error', 'Invalid card number.');
        }

        // if its first card added, set preffered to true
        $existingCardsCount = Card::where('wallet_id', $wallet->wallet_id)->count();
        $isPreferred = ($existingCardsCount === 0);

        $expiryDate = $request->expiry_date;

        // MM/YY format (12/27 => 2027-12-01)
        $expiryDate = \DateTime::createFromFormat('m/y', $expiryDate);
        
        if ($expiryDate) {

            $expiryDateFormatted = $expiryDate->format('Y-m-01');

        } else {

            return redirect()->back()->with('error', 'Invalid expiry date format');
        }
        
        $card = Card::create([
            'card_number' => $request->card_number,
            'expiry_date' => $expiryDateFormatted,
            'cardholder_name' => $request->cardholder_name,
            'cvv' => $request->cvv,
            'wallet_id' => $wallet->wallet_id,
            'preferred' => $isPreferred,
            'card_type' => $cardType,
        ]);

        return redirect('/wallet')->with('success', 'Card added successfully.');
    }

}