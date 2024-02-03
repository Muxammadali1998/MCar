<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientRegisterController extends Controller
{
    use ApiResponcer;
    public function __invoke(Request $request)
    {
        $data = Validator::make($request->all(), [
            'phone'=>'required | unique:clients',
            'name'=>'required',
            'password'=>'required | confirmed',
            'password_confirmation'=>'required',
        ]);

        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }

        $client = $request->all();
        $client['password'] = \Hash::make($request->password);
        $user = Client::create($client);
        $client = new ClientResource($user);
        $token = $user->createToken('Laravel')->accessToken;

        return $this->success(['client'=>$client,'token'=>$token], "", 201);
    }
}
