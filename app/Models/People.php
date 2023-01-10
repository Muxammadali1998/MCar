<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = [
        'path_id',
        'client_id',
        'name',
        'longitude',
        'latitude',
        'status',
        'area'
    ];
    public function path(){
        return $this->belongsTo(Path::class );
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
