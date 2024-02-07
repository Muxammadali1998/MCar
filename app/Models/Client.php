<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{
    use SoftDeletes,HasApiTokens;

    protected $fillable = [
        'name',
        'surname',
        'age',
        'photo',
        'password',
        'phone',
    ];

    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }
}
