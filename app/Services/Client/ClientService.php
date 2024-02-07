<?php

namespace App\Services\Client;

use App\Http\Resources\ClientResource;
use App\Models\Client;

class ClientService
{

    public function update($request, $id)
    {
        $client=Client::find($id);
        $client->update($request);
        $client = new ClientResource($client);
        return $client;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return true;
    }

}
