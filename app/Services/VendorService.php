<?php

namespace App\Services;

final class VendorService
{
    public static function makeCode(int $brandId, int $productId): string
    {
        return '1' .
            str_pad($brandId, 3, '0', STR_PAD_LEFT) .
            str_pad($productId, 5, '0', STR_PAD_LEFT);
    }
}
