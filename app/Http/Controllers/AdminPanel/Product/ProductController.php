<?php

namespace App\Http\Controllers\AdminPanel\Product;

use App\Brand;
use App\Categories;
use App\Http\Requests\StoreNewProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use App\Traits\LiveAware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Filters\Product\{
    BrandFilter,
    StockFilter,
    LiveFilter
};
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('title_eng', 'asc')
            ->filter($request, $this->getFilters())
            ->paginate(20);

        return view('admin.product.index', compact('products'));
    }

    protected function getFilters()
    {
        return [
            'brand' => BrandFilter::class,
            'stock' => StockFilter::class,
            'live'  => LiveFilter::class,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewProductRequest $request
     *
     * @return Response
     */
    public function store(StoreNewProductRequest $request)
    {
        $product = Product::create([
            'brand_id'          => $request->brand_id,
            'line_id'           => $request->line_id,
            'thumb_path'        => $request->thumb_path,
            'image_path'        => $request->image_path,
            'slug'              => $request->slug,
            'title_eng'         => $request->title_eng,
            'title_rus'         => $request->title_rus,
            'ph'                => $request->ph,
            'description_short' => $request->description_short,
            'description_full'  => $request->description_full,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
        ]);

        $product->save();

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.product.edit', [
            'product'    => Product::where('id', $id)->first(),
            'categories' => Categories::all(),
            'brands'     => Brand::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Product              $product
     *
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update(Product $product, UpdateProductRequest $request)
    {

        if ($request->thumb_path !== null) {
            $product->update([
                'thumb_path' => $request->thumb_path,
            ]);
        }
        if ($request->image_path !== null) {
            $product->update([
                'image_path' => $request->image_path,
            ]);
        }

        $product->update([
            'brand_id'          => $request->brand_id,
            'line_id'           => $request->line_id,
            'slug'              => $request->slug,
            'title_eng'         => $request->title_eng,
            'title_rus'         => $request->title_rus,
            'ph'                => $request->ph,
            'description_short' => $request->description_short,
            'description_full'  => $request->description_full,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
        ]);

        $product->save();

        $categories = $request->categories;
        $product->categories()->sync($categories);

        $subcategories = $request->subcategories;
        $product->subcategories()->sync($subcategories);

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return back();
    }


    public function forceDelete($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->forceDelete();
    }

    /**
     * Toggle the specified resource from storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function toggle(Request $request)
    {
        if ($request->checked) {
            $checked = 1;
        } else {
            $checked = 0;
        }

        $product = Product::find($request->id);
        $product->update(['live' => $checked]);

        return response(['data' => 'Успешно'], 200);
    }

    public function stockToggle(Request $request)
    {
        if ($request->checked) {
            $checked = 1;
        } else {
            $checked = 0;
        }

        $product = Product::find($request->id);
        $product->update(['stock' => $checked]);

        return response(['data' => 'Успешно'], 200);
    }

    public function price(Request $request)
    {

        $product = Product::find($request->id);
        $product->update(['price' => $request->value]);

        return response(['data' => 'Успешно'], 200);
    }

    public function discount(Request $request)
    {

        $product = Product::find($request->id);
        $product->update(['discount' => $request->value]);

        return response(['data' => 'Успешно'], 200);
    }

    public function productAssociateRelated(Product $product, Request $request)
    {
        $products = $request->toArray();

        $productsID = array_column($products, 'id');

        $product->related()->sync($productsID);
    }
}
