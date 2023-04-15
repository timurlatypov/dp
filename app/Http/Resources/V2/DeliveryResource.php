<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return (\Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed)[]
     *
     * @psalm-return array{id: mixed, name: mixed, slug: mixed, children: \Illuminate\Http\Resources\Json\AnonymousResourceCollection, products: \Illuminate\Http\Resources\Json\AnonymousResourceCollection}
     */
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'slug'     => $this->slug,
            'children' => DeliveryResource::collection($this->whenLoaded('delivery')),
            'products' => ProductResource::collection($this->products()->deliverable()->live()->get()),
        ];
    }
}
