<?php

namespace App\Repositories;

use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;

class CarRepository implements Interfaces\CarRepositoryInterface
{

    public function getAll()
    {
        $cars = CarResource::collection(Car::all());
        return $cars;
    }

    public function getOne($car)
    {
        $car = new CarResource($car);
        return $car;
    }
}
