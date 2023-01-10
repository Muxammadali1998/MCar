<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'model',
        'marka',
        'smoking',
        'animals',
        'music',
        'speaking',
        'type',
        'coller',
        'year',
        'client_id'
    ];

    protected $rules = [
        'number' => 'sometimes|required|number|unique:cars',
    ];
}
