<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'client_id',
        'start_time',
        'finish_time',
        'comfort',
        'area',
        'check'    
    ];
    public function user(){
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function locations(){
        return $this->hasMany(Location::class);
    }

    public function peoples(){
        return $this->hasMany(People::class);
    }
}
