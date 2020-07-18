<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientResourceJson extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'emails' => new ClientEmailResource($this->emails),
            'phones' => new ClientPhoneResource($this->phones)
        ];
    }
}
