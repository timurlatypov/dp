<?php

namespace App\Http\Resources\V2\Cart;

use App\Cart\Money;
use App\Http\Resources\V2\ProductIndexResource;
use App\Http\Resources\V2\ProductVariationResource;
use Illuminate\Http\Request;

class CartProductVariationResource extends ProductVariationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return (ProductIndexResource|mixed)[]
     */
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'product'  => new ProductIndexResource($this->product),
            'quantity' => $this->pivot->quantity,
            'total'    => $this->getTotal()->formatted(),
        ]);
    }

    protected function getTotal(): Money
    {
        return new Money($this->pivot->quantity * $this->price->amount());
    }
}
