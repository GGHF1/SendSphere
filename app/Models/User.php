<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'fname',
        'lname',
        'country_id',
        'city_id',
        'address',
        'zip',
        'phone',
        'email',
        'username',
        'password',
        'DOB',
        'gender',
    ];

    protected $dates = ['email_verified_at'];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id'); 
    }

    public function wallet(){
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function card(){
        return $this->hasManyThrough(Card::class, Wallet::class);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->wallet()->create(['balance' => 0]);
        });
    }
}