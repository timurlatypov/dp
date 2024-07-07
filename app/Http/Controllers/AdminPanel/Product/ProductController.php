<?php

namespace App\Http\Controllers\AdminPanel\Product;

use App\Filters\Product\BrandFilter;
use App\Filters\Product\LiveFilter;
use App\Filters\Product\StockFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
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

    /**
     * @return string[]
     *
     * @psalm-return array{brand: BrandFilter::class, stock: StockFilter::class, live: LiveFilter::class}
     */
    protected function getFilters(): array
    {
        return [
            'brand' => BrandFilter::class,
            'stock' => StockFilter::class,
            'live' => LiveFilter::class,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\Contracts\View\View
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
     * @return RedirectResponse
     */
    public function store(StoreNewProductRequest $request)
    {
        $product = Product::create([
            'brand_id' => $request->brand_id,
            'line_id' => $request->line_id,
            'thumb_path' => $request->thumb_path,
            'image_path' => $request->image_path,
            'slug' => $request->slug,
            'title_eng' => $request->title_eng,
            'title_rus' => $request->title_rus,
            'ph' => $request->ph,
            'description_short' => $request->description_short,
            'description_full' => $request->description_full,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        $product->save();

        return redirect()->route('admin.product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        return view('admin.product.edit', [
            'product' => Product::where('id', $id)->first(),
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, UpdateProductRequest $request): RedirectResponse
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
            'brand_id' => $request->brand_id,
            'line_id' => $request->line_id,
            'slug' => $request->slug,
            'title_eng' => $request->title_eng,
            'title_rus' => $request->title_rus,
            'ph' => $request->ph,
            'description_short' => $request->description_short,
            'description_full' => $request->description_full,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
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
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = Product::find($id);
        $product->delete();

        return back();
    }

    public function forceDelete($id): void
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->forceDelete();
    }

    /**
     * Toggle the specified resource from storage.
     *
     * @return Response|ResponseFactory
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

    /**
     * @return Response|ResponseFactory
     */
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

    /**
     * @return Response|ResponseFactory
     */
    public function price(Request $request)
    {
        $product = Product::find($request->id);
        $product->update(['price' => $request->value]);

        return response(['data' => 'Успешно'], 200);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function discount(Request $request)
    {
        $product = Product::find($request->id);
        $product->update(['discount' => $request->value]);

        return response(['data' => 'Успешно'], 200);
    }

    public function productAssociateRelated(Product $product, Request $request): void
    {
        $products = $request->toArray();

        $productsID = array_column($products, 'id');

        $product->related()->sync($productsID);
    }
}
