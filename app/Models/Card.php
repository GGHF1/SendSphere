<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'card_number', 'expiry_date', 'cardholder_name'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}