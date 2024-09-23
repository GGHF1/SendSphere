<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'fname',
        'lname',
        'country',
        'city',
        'address',
        'zip',
        'phone',
        'email',
        'username',
        'password',
        'DOB',
        'gender',
    ];
}