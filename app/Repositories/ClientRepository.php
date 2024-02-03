<?php

namespace App\Repositories;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository implements Interfaces\ClientRepositoryInterface
{

    public function getAll()
    {
        $clients = ClientResource::collection(Client::all());
        return $clients;
    }

    public function find($client)
    {
        return new ClientResource($client);
    }
}
