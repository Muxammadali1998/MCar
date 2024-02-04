<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'number',
        'model',
        'name',
        'cooler',
        'year',
        'type',
        'photo',
        'is_comfort',
        'smoke',
        'conversation',
        'animals',
        'music',
    ];
}
