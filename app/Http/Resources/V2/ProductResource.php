<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return (\Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed)[]
     *
     * @psalm-return array{variations: \Illuminate\Http\Resources\Json\AnonymousResourceCollection, images: \Illuminate\Http\Resources\Json\AnonymousResourceCollection, categories: mixed,...}
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            [
                'variations' => ProductVariationResource::collection(
                    $this->variations->groupBy('type.name')
                ),
                'images' => ImageResource::collection(
                    $this->images
                ),
                'categories' => $this->categoriesArray(),
            ]
        );
    }
}
