<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateRequest;
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

    public function show($id)
    {
        $client = $this->clientRepository->find($id);
        return $this->success($client);
    }

    public function getClientInfos(Request $request)
    {
        $client = $this->clientRepository->getClientInfos($request);
        return $this->success($client);
    }


}
