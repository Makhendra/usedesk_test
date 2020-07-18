<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientResource extends ResourceCollection
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
            'data' => $this->resource->map(
                function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'last_name' => $item->last_name,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                        'emails' => new ClientEmailResource($item->emails),
                        'phones' => new ClientPhoneResource($item->phones)
                    ];
                }
            ),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
