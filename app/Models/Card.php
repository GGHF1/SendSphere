<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $primaryKey = 'card_id';

    protected $fillable = [
        'card_number',
        'expiry_date',
        'cardholder_name',
        'cvv',
        'wallet_id',
        'preferred',
        'card_type',
    ];
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}