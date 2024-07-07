<?php

namespace App\Cart;

use App\Exceptions\Cart\InvalidRowIDException;
use App\Models\ShippingMethod;
use Illuminate\Support\Collection;

class Cart
{
    private const DEFAULT_INSTANCE = 'default';

    private string $instance;
    protected bool $changed = false;
    protected int $shipping;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->instance(self::DEFAULT_INSTANCE);
    }

    /**
     * @psalm-param 'default'|null $instance
     */
    public function instance(?string $instance = null): static
    {
        $instance = $instance ?: self::DEFAULT_INSTANCE;

        $this->instance = sprintf('%s.%s', 'cart', $instance);

        return $this;
    }

    /**
     * @return static
     */
    public function withShipping(int $shippingId): self
    {
        $this->shipping = ShippingMethod::find($shippingId);

        return $this;
    }

    public function add($id): void
    {
        $cartItem = $this->createCartItem($id);

        $content = $this->getContent();

        if ($content->has($cartItem->getRowId())) {
            $cartItem->qty += $content->get($cartItem->getRowId())->qty;
        }

        $content->put($cartItem->getRowId(), $cartItem);

        session()->put($this->instance, $content);
    }

    public function update($rowId, $qty)
    {
        $cartItem = $this->get($rowId);
        $cartItem->qty = $qty;

        $content = $this->getContent();

        if ($rowId !== $cartItem->rowId) {
            $content->pull($rowId);

            if ($content->has($cartItem->rowId)) {
                $existingCartItem = $this->get($cartItem->rowId);
                $cartItem->setQuantity($existingCartItem->qty + $cartItem->qty);
            }
        }

        if ($cartItem->qty <= 0) {
            $this->remove($cartItem->rowId);

            return;
        }
            $content->put($cartItem->rowId, $cartItem);

        session()->put($this->instance, $content);
    }

    /**
     * Remove the cart item with the given rowId from the cart.
     */
    public function remove(string $rowId): void
    {
        $cartItem = $this->get($rowId);

        $content = $this->getContent();

        $content->pull($cartItem->rowId);

        session()->put($this->instance, $content);
    }

    public function get(string $rowId)
    {
        $content = $this->getContent();

        if (!$content->has($rowId)) {
            throw new InvalidRowIDException("The cart does not contain rowId {$rowId}.");
        }

        return $content->get($rowId);
    }

    public function getContent(): Collection
    {
        return session()->has($this->instance)
            ? session()->get($this->instance)
            : new Collection();
    }

    /**
     * @return Money
     */
    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function ($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });

        return new Money($subtotal);
    }

    /**
     * @return Money
     */
    public function total()
    {
        if ($this->shipping) {
            return $this->subtotal()->add($this->shipping->price);
        }

        return $this->subtotal();
    }

    public function sync(): void
    {
        $this->user->cart->each(function ($product) {
            $quantity = $product->minStock($product->pivot->quantity);

            if ($quantity != $product->pivot->quantity) {
                $this->changed = true;
            }

            $product->pivot->update([
                'quantity' => $quantity,
            ]);
        });
    }

    public function hasChanged(): bool
    {
        return $this->changed;
    }

    private function createCartItem($id, $qty = 1): CartItem
    {
        return new CartItem($id, $qty);
    }
}
