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

    public function find($id)
    {
        $client = Client::find($id);
        $client = new ClientResource($client);
        return $client;
    }

    public function getClientInfos($request)
    {
        $client = $request->user();
        return $client;
    }
}
