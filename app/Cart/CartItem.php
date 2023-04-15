<?php

namespace App\Cart;

class CartItem
{
    public int $productVariationiId;
    public string $rowId;
    public int $qty;

    /**
     * CartItem constructor.
     *
     * @param int $productVariationiId
     * @param int $qty
     */
    public function __construct(int $productVariationiId, int $qty = 0)
    {
        $this->productVariationiId = $productVariationiId;
        $this->qty = $qty;
        $this->rowId = md5($productVariationiId);
    }

    public function setQuantity(int $qty): void
    {
        $this->qty = $qty;
    }

    public function getRowId(): string
    {
        return $this->rowId;
    }

    /**
     * @return (int|string)[]
     *
     * @psalm-return array{rowId: string, productVariationiId: int, qty: int}
     */
    public function toArray(): array
    {
        return [
            'rowId' => $this->rowId,
            'productVariationiId' => $this->productVariationiId,
            'qty' => $this->qty,
        ];
    }
}
