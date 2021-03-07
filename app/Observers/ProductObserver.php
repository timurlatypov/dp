<?php

namespace App\Observers;

use App\Product;
use App\Jobs\Product\MakeVendorCodeJob;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param Product $product
     *
     * @return void
     */
    public function created(Product $product): void
    {
        MakeVendorCodeJob::dispatch($product['id']);
    }
}
