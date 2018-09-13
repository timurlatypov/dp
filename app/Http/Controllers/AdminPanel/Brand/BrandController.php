<?php

namespace App\Http\Controllers\AdminPanel\Brand;

use App\Brand;
use App\Line;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
	public function show_product(Brand $brand, Product $product)
	{
		if(!$product = $brand->products()->where('slug', $product->slug)->live()->first())
		{
			abort(404);
		}
		return view('web.product', compact(['brand', 'product']));
	}

    public function show_brand_products(Brand $brand)
    {
    	$products = $brand->products()->orderBy('title_eng', 'asc')->live()->paginate(21);
        return view('web.brand', compact(['brand', 'products']));
    }

    public function show_brand_line_products(Brand $brand, Line $line)
    {
	    $products = $line->products()->orderBy('order_id', 'asc')->live()->paginate(21);
	    return view('web.brand', compact(['brand', 'line', 'products']));
    }
}
