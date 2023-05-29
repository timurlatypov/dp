<?php

namespace App\Traits;

use App\Cart\Money;

trait HasPrice
{
	public function getPriceAttribute(int $value): Money
    {
		return new Money($value);
	}

	public function getFormattedPriceAttribute(): string
	{
		return $this->price->formatted();
	}

    public function getFormattedSubtotalAttribute(): string
    {
        return $this->subtotal->formatted();
    }
}
