<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use ApiResponcer;
    public function __construct(public ClientService $clientService, public ClientRepository $clientRepository)
    {
    }

    public function index()
    {
        $clients = $this->clientRepository->getAll();
        return $this->success($clients);
    }

    public function show(Client $client)
    {
        $client = $this->clientRepository->find($client);
        return $this->success($client);
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => ['required'],
            'surname' => ['nullable'],
            'age' => ['nullable'],
            'photo' => ['nullable'],
            'password' => ['required'],
        ]);

        $client->update($data);

        return new ClientResource($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json();
    }
}
