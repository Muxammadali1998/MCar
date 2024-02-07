<?php

namespace App\Services\Client;

use App\Models\Car;

class CarService
{
    public function store($request)
    {
        $client = auth()->guard('api')->user();
        $car = $client->car()->updateOrCreate([
            'client_id' => $client->id
        ], [
            $request
        ]);
        return $car;
    }

    public function destroy($id)
    {
        Car::destroy($id);
    }

}
