<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cities;

class Countries extends Model
{
    protected $fillable = ['name', 'code'];

    public function cities()
    {
        return $this->hasMany(Cities::class, 'country_id');
    }
}
