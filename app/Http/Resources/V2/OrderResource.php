<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request  $request
     *
     * @return (AddressResource|ShippingMethodsResource|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|mixed)[]
     *
     * @psalm-return array{id: mixed, status: mixed, created_at: mixed, subtotal: mixed, total: mixed, products: AnonymousResourceCollection, address: AddressResource, shipping: ShippingMethodsResource}
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
	        'status' => $this->status,
	        'created_at' => $this->created_at->toDateTimeString(),
	        'subtotal' => $this->subtotal->formatted(),
	        'total' => $this->total()->formatted(),
	        'products' => ProductVariationResource::collection(
	        	$this->whenLoaded('products')
	        ),
	        'address' => new AddressResource(
	        	$this->whenLoaded('address')
	        ),
	        'shipping' => new ShippingMethodsResource(
		        $this->whenLoaded('shippingMethod')
	        )
        ];
    }
}
