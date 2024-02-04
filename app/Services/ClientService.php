<?php

namespace App\Services;

use App\Http\Resources\ClientResource;
use App\Models\Client;

class ClientService
{

    public function update($request, $client)
    {
        $client->update($request->validate);
        $client = new ClientResource($client);
        return $client;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return true;
    }

}
