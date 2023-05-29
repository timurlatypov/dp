<?php

namespace App\Console\Commands\Product;

use App\Models\Product;
use Illuminate\Console\Command;

class UpdateProductImagesPaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:update_paths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновить пути к картинкам продукта';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $products = Product::query()
            ->withTrashed()
            ->where('id', '>=', 1)
            ->where('id', '<=', 404)
            ->get();

        foreach ($products as $product) {

            if (str_starts_with($product->image_path, 'products/image') &&
                str_starts_with($product->thumb_path, 'products/thumb')) {
                continue;
            }

            $product->image_path = 'products/image/' . $product->image_path;
            $product->thumb_path = 'products/thumb/' . $product->thumb_path;
            $product->save();

        }

        echo $products->count();

        return 0;
    }
}
