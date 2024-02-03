<?php

namespace App\Services;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Resources\ClientResource;

class ClientService{
    use ApiResponcer;

    public function update($request, $client){
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

}
