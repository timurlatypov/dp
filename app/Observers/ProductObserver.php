<?php

namespace App\Observers;

use App\Jobs\Product\MakeVendorCodeJob;
use App\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param Product $product
     *
     * @return void
     */
    public function created(Product $product)
    {
        MakeVendorCodeJob::dispatch($product['id']);
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param Product $product
     *
     * @return void
     */
    public function updated(Product $product)
    {

    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param Product $product
     *
     * @return void
     */
    public function deleted(Product $product)
    {

    }

    /**
     * Handle the Product "restored" event.
     *
     * @param Product $product
     *
     * @return void
     */
    public function restored(Product $product)
    {

    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param Product $product
     *
     * @return void
     */
    public function forceDeleted(Product $product)
    {

    }
}
