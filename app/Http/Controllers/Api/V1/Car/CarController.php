<?php

namespace App\Http\Controllers\Api\V1\Car;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Repositories\CarRepository;
use App\Services\CarService;

class CarController extends Controller
{
    use ApiResponcer;

    public function __construct(public CarRepository $carRepository, public CarService $carService)
    {
    }

    public function index(){
        $cars = $this->carRepository->getAll();
        return $this->success($cars);
    }
    public function store(CarRequest $request)
    {
       $car = $this->carService->store($request->validated());
        return $this->success($car);
    }

    public function show(Car $car)
    {
        $car = $this->carRepository->getOne($car);
        return $this->success($car);
    }

    public function update(CarRequest $request, Car $car)
    {
       $car =  $this->carService->update($request->validated(), $car);
        return $this->success($car);
    }

    public function destroy(Car $car)
    {
        $response = $this->carService->destroy($car);
        return $this->success($response);
    }
}
