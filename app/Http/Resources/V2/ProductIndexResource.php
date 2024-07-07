<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return (bool|mixed)[]
     *
     * @psalm-return array{id: mixed, name: mixed, description: mixed, slug: mixed, live: bool, deliverable: bool, spicy: bool, top: bool, price: mixed, in_stock: mixed, images: mixed}
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'live' => (bool) $this->live,
            'deliverable' => (bool) $this->deliverable,
            'spicy' => (bool) $this->spicy,
            'top' => (bool) $this->top,
            'price' => $this->formattedPrice,
            'in_stock' => $this->inStock(),
            'images' => $this->images,
        ];
    }
}
