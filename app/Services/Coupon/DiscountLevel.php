<?php

namespace App\Services\Coupon;

use App\Brand;
use App\Coupon;
use Gloudemans\Shoppingcart\Cart;

final class DiscountLevel
{
    public const SETS_ID = 11;

    /**
     * @param Cart   $cart
     * @param Coupon $coupon
     */
    public static function product(Cart $cart, Coupon $coupon): void
    {
        foreach ($cart->content() as $rowId => $item) {
            if ($item->options['product_id'] == $coupon->entity_id) {
                $item->options['coupon'] = $coupon->discount;
                $cart->update($rowId, ['options' => $item->options]);
            }
        }
    }

    /**
     * @param Cart   $cart
     * @param Coupon $coupon
     */
    public static function brand(Cart $cart, Coupon $coupon): void
    {
        foreach ($cart->content() as $rowId => $item) {
            if ($item->options['brand_id'] == $coupon->entity_id) {
                $item->options['coupon'] = $coupon->discount;
                $cart->update($rowId, ['options' => $item->options]);
            }
        }
    }

    /**
     * @param Cart   $cart
     * @param Coupon $coupon
     */
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
