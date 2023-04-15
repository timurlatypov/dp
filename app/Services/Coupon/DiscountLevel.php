<?php

namespace App\Services\Coupon;

use App\Models\Brand;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Cart;

final class DiscountLevel
{
    public const SETS_ID = 11;

    public static function product(Cart $cart, Coupon $coupon): void
    {
        foreach ($cart->content() as $rowId => $item) {
            if ($item->options['product_id'] == $coupon->entity_id) {
                $item->options['coupon'] = $coupon->discount;
                $cart->update($rowId, ['options' => $item->options]);
            }
        }
    }

    public static function brand(Cart $cart, Coupon $coupon): void
    {
        foreach ($cart->content() as $rowId => $item) {
            if ($item->options['brand_id'] == $coupon->entity_id) {
                $item->options['coupon'] = $coupon->discount;
                $cart->update($rowId, ['options' => $item->options]);
            }
        }
    }

    public static function all(Cart $cart, Coupon $coupon): void
    {
        foreach ($cart->content() as $rowId => $item) {
            if (!in_array($item->options['brand_id'], Brand::EXCLUDE)) {
                $item->options['coupon'] = $coupon->discount;
                $cart->update($rowId, ['options' => $item->options]);
            }
        }
    }
}
