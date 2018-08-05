<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Product;
use App\Subcategory;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('landing-page');
    }


    public function novelties()
    {
	    $products = Product::novelties()->live()->paginate(21);
	    return view('web.novelties', compact(['products']));
    }

	public function bestsellers()
	{
		$products = Product::bestsellers()->live()->paginate(21);
		return view('web.bestsellers', compact(['products']));
	}



	public function category(Categories $categories)
	{
		$products = $categories->products()->paginate(21);
		return view('web.category', compact(['products', 'categories']));
	}


	public function subcategory(Categories $categories, Subcategory $subcategory)
	{
		$products = $subcategory->products()->paginate(21);

		return view('web.category', compact(['products', 'categories', 'subcategory']));
	}



	public function forKids()
	{
		return view('web.for-kids');
	}

	public function discounts()
	{
		$products = Product::discount()->live()->paginate(21);
		return view('web.discounts', compact(['products']));
	}

}
