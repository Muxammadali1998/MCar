<?php
namespace  App\Repositories\Interfaces;
interface CarRepositoryInterface {
    public function getOne($car);
    public function getAll();
}
