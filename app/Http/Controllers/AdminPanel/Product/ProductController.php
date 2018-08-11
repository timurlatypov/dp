<?php

namespace App\Http\Controllers\AdminPanel\Product;

use App\Brand;
use App\Categories;
use App\Http\Requests\StoreNewProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::orderBy('id', 'desc')->paginate(50);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('admin.product.create', [
		    'brands' => Brand::all()
	    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewProductRequest $request)
    {
	    //dd($request);

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

	    return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    return view('admin.product.edit', [
		    'product' => Product::where('id', $id)->first(),
		    'categories' => Categories::all(),
		    'brands' => Brand::all()
	    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
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

	    $categories = $request->categories;
	    $product->categories()->sync($categories);

	    $subcategories = $request->subcategories;
	    $product->subcategories()->sync($subcategories);

	    return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	/**
	 * Toggle the specified resource from storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
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
}
