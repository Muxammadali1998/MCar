<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'start_time'=>$this->start_time,
            'finish_time'=>$this->finish_time,
            // 'reating'=>$this->user->reating($this->user->rating),
            'user'=>$this->user,
            'area'=>$this->area,
            'locations'=>$this->locations,
            "time1"=>$this->created_at,
            "time2"=>$this->updated_at
        ];
    }
}
