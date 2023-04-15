<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponOptionsController extends Controller
{
    public function get($level)
    {
        switch ($level) {
            case 'brand';
                return Brand::all()->map(function ($brand) {
                    return ['value' => $brand->id, 'display' => $brand->name];
                });
            case 'line';
                return Line::all()->map(function ($line) {
                    return ['value' => $line->id, 'display' => $line->brand->name . ' - ' . $line->name];
                });
            case 'product':
                return Product::orderBy('brand_id')->live()->get()->map(function ($product) {
                    return ['value' => $product->id, 'display' => $product->brand->name . ' - ' . $product->title_eng];
                });

            default:
                return [];
        }
    }
}
