<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
 
class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'photo',
        'age',
    ];

    public function ratings(){
        return $this->hasMany(Rating::class, 'to_id');
    }
    public function paths(){
        return $this->hasOne (Path::class);
    }
    public function car(){
        return $this->hasOne(Car::class);
    }
    public function rating($all)
    {
        foreach ($all as  $item) {
            $rating[] = $item->rating;
        }
        
        if(isset($rating)){
           return array_sum($rating)/count($rating);
        }
    }

     
}
