<?php

namespace App\Http\Controllers\API\V1;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Line;
use App\Product;
use Illuminate\Http\Request;

class CouponOptionsController extends Controller
{
    public function get($level)
    {
        switch ($level) {
            case 'brand';
                $brands = Brand::all();

                return $brands->map(function ($brand) {
                    return ['value' => $brand->id, 'display' => $brand->name];
                });
            case 'line';
                $lines = Line::all();

                return $lines->map(function ($line) {
                    return ['value' => $line->id, 'display' => $line->brand()->first()->name . ' - ' . $line->name];
                });
            case 'product':
                $products = Product::all();

                return $products->map(function ($product) {
                    return ['value' => $product->id, 'display' => $product->brand()->first()->name . ' - ' . $product->title_eng];
                });

            default:
                return [];
        }
    }
}
