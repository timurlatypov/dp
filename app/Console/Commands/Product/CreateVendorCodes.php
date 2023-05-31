<?php

namespace App\Console\Commands\Product;

use App\Models\Product;
use App\Services\VendorService;
use Illuminate\Console\Command;

class CreateVendorCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create_vendor_codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда создаёт для всех продуктов номер артикула.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $products = Product::withTrashed()->get();

        foreach ($products as $product) {
            $brand = $product->brand()->first();

            $product->update([
                'vendor_code' => VendorService::makeCode($brand->id, $product->id),
            ]);

            $product->save();
        }

        return 0;
    }
}
