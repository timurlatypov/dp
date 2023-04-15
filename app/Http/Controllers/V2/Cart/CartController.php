<?php

namespace App\Http\Controllers\V2\Cart;

use App\Cart\Cart;
use App\Http\Requests\V2\Cart\CartStoreRequest;
use App\Http\Requests\V2\Cart\CartUpdateRequest;
use App\Http\Resources\V2\Cart\CartResource;
use App\Models\ProductVariation;
use App\Models\ShippingMethod;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    protected Cart $cart;

    /**
     * @return (bool|mixed)[]
     */
    protected function meta(Cart $cart, Request $request, ShippingMethod $shipping): array
    {
        return [
            'empty'        => $cart->isEmpty(),
            'subtotal'     => $cart->subtotal()->formatted(),
            'total'        => $cart->withShipping($request->shipping_method ? : $shipping->defaultId())->total()->formatted(),
            'changed'      => $cart->hasChanged(),
            'min_amount'   => $cart->subtotal() > $cart->minAmount(),
            'working_time' => $cart->isWorkingTime(),
        ];
    }

    /**
     * CartController constructor.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->middleware(['auth:api']);
        $this->cart = $cart;
    }

    /**
     * @param Request        $request
     * @param Cart           $cart
     * @param ShippingMethod $shipping
     *
     * @return CartResource
     */
    public function index(Request $request, Cart $cart, ShippingMethod $shipping): CartResource
    {
        $cart->sync();

        $request->user()->load([
            'cart.product',
            'cart.product.images',
            'cart.product.variations.stock',
            'cart.stock',
        ]);

        return (new CartResource($request->user()))
            ->additional([
                'meta' => $this->meta($cart, $request, $shipping),
            ]);
    }

    /**
     * @param CartStoreRequest $request
     * @param User             $user
     */
    public function store(CartStoreRequest $request): void
    {
        $this->cart->add($request->products);
    }

    /**
     * @param ProductVariation  $productVariation
     * @param CartUpdateRequest $request
     * @param Cart              $cart
     */
    public function update(ProductVariation $productVariation, CartUpdateRequest $request, Cart $cart): void
    {
        $cart->update($productVariation->id, $request->quantity);
    }

    /**
     * @param ProductVariation $productVariation
     * @param Cart             $cart
     */
    public function destroy(ProductVariation $productVariation, Cart $cart): void
    {
        $cart->delete($productVariation->id);
    }
}
