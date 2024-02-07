<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Services\Client\CarService;

class CarController extends Controller
{
    use ApiResponcer;

    public function __construct(public CarService $carService)
    {
    }

    public function store(CarRequest $request)
    {
        $car = $this->carService->store($request->validated());
        return $this->success($car);
    }

    public function destroy($id)
    {
        $this->carService->destroy($id);
        return $this->success();
    }
}
