<?php

namespace App\Http\Controllers\AdminPanel\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Line;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BrandController extends Controller
{
    /**
     * @return Factory|View
     */
    public function show_product(Brand $brand, Product $product)
    {
        if (!$product = $brand->products()->where('slug', $product->slug)->live()->first()) {
            abort(404);
        }

        return view('web.product', [
            'brand' => $brand,
            'product' => $product,
            'reviews' => $product->getReviews(),
            'rating' => $product->getAverageRating(),
            'display' => $product->getProperDisplay(),
        ]);
    }

    /**
     * @return Factory|View
     */
    public function show_brand_products(Brand $brand)
    {
        $products = $brand->products()->orderBy('order_id', 'asc')->live()->paginate(20);

        return view('web.brand', compact(['brand', 'products']));
    }

    /**
     * @return Factory|View
     */
    public function show_brand_line_products(Brand $brand, Line $line)
    {
        $products = $line->products()->orderBy('order_id', 'asc')->live()->paginate(20);

        return view('web.brand', compact(['brand', 'line', 'products']));
    }
}
