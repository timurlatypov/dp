<?php

namespace App\Http\Controllers\AdminPanel\Brand;

use App\Brand;
use App\Line;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }




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




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
