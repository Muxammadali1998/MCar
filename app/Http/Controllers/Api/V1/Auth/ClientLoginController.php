<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientLoginController extends Controller
{
    use ApiResponcer;

    public function __invoke(LoginRequest $request)
    {
        if (auth()->guard('api')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $token = auth()->guard('api')->user()->createToken('Laravel')->accessToken;
            return $this->success($token, "", 201);
        } else {
            return $this->error("", 400, 'parol xato');
        }
    }
}
