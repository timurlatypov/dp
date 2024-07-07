<?php

namespace App\Http\Controllers\AdminPanel\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\UpdateDiscountRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DiscountController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $brands = Brand::all();

        return view('admin.discount.index', compact('brands'));
    }

    /**
     * @return RedirectResponse
     */
    public function update(UpdateDiscountRequest $request)
    {
        $products = Product::where('brand_id', $request->brand)->get();
        $brand = Brand::where('id', $request->brand)->first();

        foreach ($products as $product) {
            $product->update([
                'discount' => $request->discount,
            ]);
            $product->save();
        }

        return redirect()->back()->with('flash', 'Скидки для бренда ' . $brand->name . ' обновились!');
    }
}
