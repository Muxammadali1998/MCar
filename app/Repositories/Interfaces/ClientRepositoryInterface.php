<?php
namespace App\Repositories\Interfaces;

interface ClientRepositoryInterface{
    public function getAll();
    public function find($client);

}
