<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Car */
class CarResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'number' => $this->number,
            'model' => $this->model,
            'name' => $this->name,
            'cooler' => $this->cooler,
            'year' => $this->year,
            'type' => $this->type,
            'photo' => $this->photo,
            'is_comfort' => $this->is_comfort,
            'smoke' => $this->smoke,
            'conversation' => $this->conversation,
            'animals' => $this->animals,
            'music' => $this->music,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
