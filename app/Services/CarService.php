<?php

namespace App\Services;

use App\Http\Resources\CarResource;
use App\Models\Car;

class CarService
{
    public function store($request)
    {
        $car = new CarResource(Car::create($request));
        return $car;
    }

    public function update($request, $car)
    {

        $car->update($request);
        $car = new CarResource($car);
        return $car;
    }

    public function destroy($car)
    {
        $response = $car->delete();
        return $response;
    }
}
