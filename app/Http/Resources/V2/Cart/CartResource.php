<?php

namespace App\Http\Resources\V2\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
	 * Transform the resource into an array.
	 *
	 * @param \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection[]
	 *
	 * @psalm-return array{products: \Illuminate\Http\Resources\Json\AnonymousResourceCollection}
	 */
	public function toArray($request): array
    {
		return [
			'products' => CartProductVariationResource::collection($this->cart)
		];
	}
}
