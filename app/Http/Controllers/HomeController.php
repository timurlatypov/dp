<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Categories;
use App\Product;
use App\Subcategory;
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
        $products   = Product::where('novelty', 1)->live()->paginate(21);

        return view('web.template', compact(['products', 'categories']));
    }

    public function bestsellers()
    {
        $categories = Categories::where('slug', 'bestsellers')->first();
        $products   = $categories->products()->live()->paginate(21);

        return view('web.template', compact(['products', 'categories']));
    }

    public function premium()
    {
        $categories = Categories::where('slug', 'premium')->first();
        $products   = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    public function eightMarch()
    {
        $categories = Categories::where('slug', '8march')->first();
        $products   = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    public function set()
    {
        $brand    = Brand::where('slug', 'sets')->first();
        $products = $brand->products()->live()->paginate(21);

        return view('web.sets', compact(['products', 'brand']));
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

    public function sdek()
    {
        return view('web.sdek');
    }

    public function sdekPoints()
    {
        return view('web.sdek-points');
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
