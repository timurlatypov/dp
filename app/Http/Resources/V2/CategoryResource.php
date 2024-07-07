<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return (\Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed)[]
     *
     * @psalm-return array{id: mixed, name: mixed, slug: mixed, children: \Illuminate\Http\Resources\Json\AnonymousResourceCollection, products: \Illuminate\Http\Resources\Json\AnonymousResourceCollection, image: \Illuminate\Http\Resources\Json\AnonymousResourceCollection, sketch: \Illuminate\Http\Resources\Json\AnonymousResourceCollection}
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'products' => ProductResource::collection($this->products()->live()->get()),
            'image' => CategoryImageResource::collection($this->image),
            'sketch' => CategorySketchResource::collection($this->sketch),
        ];
    }
}
