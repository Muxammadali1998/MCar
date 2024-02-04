<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientAccountController extends Controller
{
    use ApiResponcer;

    public function __construct(public ClientService $clientService, public ClientRepository $clientRepository)
    {
    }
    public function update(UpdateRequest $request, Client $client)
    {
        $client = $this->clientService->update($request, $client);
        return $this->success($client);
    }

    public function destroy(Client $client)
    {
        $this->clientService->destroy($client);
        return $this->success();
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->success([], 'account logged out');
    }
}
