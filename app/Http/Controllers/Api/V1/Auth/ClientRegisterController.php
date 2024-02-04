<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RegisterRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;

class ClientRegisterController extends Controller
{
    use ApiResponcer;
    public function __invoke(RegisterRequest $request)
    {

        $client = $request->all();
        $client['password'] = \Hash::make($request->password);
        $user = Client::create($client);
        $client = new ClientResource($user);
        $token = $user->createToken('Laravel')->accessToken;

        return $this->success(['client'=>$client,'token'=>$token], "", 201);
    }
}
