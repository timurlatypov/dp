<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Product;
use App\Subcategory;
use App\User;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Cart;

class HomeController extends Controller
{

    public function index()
    {
        return view('landing-page');
    }

    public function novelties()
    {
    	$categories = Categories::where('slug', 'new-products')->first();
	    $products = $categories->products()->live()->paginate(21);
	    return view('web.template', compact(['products','categories']));
    }

	public function bestsellers()
	{
		$categories = Categories::where('slug', 'bestsellers')->first();
		$products = $categories->products()->live()->paginate(21);
		return view('web.template', compact(['products','categories']));
	}

	public function discounts()
	{
		$products = Product::discount()->live()->paginate(21);
		return view('web.discounts', compact(['products']));
	}

	public function contacts()
	{
		return view('web.contacts');
	}

	public function bookmarks(Cart $bookmark)
	{
		$bookmarks = $bookmark->instance('bookmark')->content();
		return view('web.bookmark', compact('bookmarks'));
	}

	public function confidentiality()
	{
		return view('web.confidentiality');
	}

	public function delivery()
	{
		return view('web.delivery');
	}

	public function loyalty()
	{
		return view('web.loyalty');
	}

	public function category(Categories $categories)
	{
		$products = $categories->products()->live()->orderBy('title_eng', 'asc')->paginate(21);
		return view('web.category', compact(['products', 'categories']));
	}

	public function subcategory(Categories $categories, Subcategory $subcategory)
	{
		$products = $subcategory->products()->live()->orderBy('title_eng', 'asc')->paginate(21);
		return view('web.category', compact(['products', 'categories', 'subcategory']));
	}

	public function forKids()
	{
		return view('web.for-kids');
	}

	public function success()
	{
		return view('web.status.success');
	}

	public function failure()
	{
		return view('web.status.failure');
	}
}
