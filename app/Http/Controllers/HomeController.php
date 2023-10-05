<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Gloudemans\Shoppingcart\Cart;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('landing-page');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function novelties()
    {
        $categories = Category::where('slug', 'new-products')->first();
        $products = Product::where('novelty', 1)->live()->paginate(21);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function bestsellers()
    {
        $categories = Category::where('slug', 'bestsellers')->first();
        $products = $categories->products()->live()->paginate(21);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function premium()
    {
        $categories = Category::where('slug', 'premium')->first();
        $products = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fourteenthFeb()
    {
        $categories = Category::where('slug', '14feb')->first();
        $products = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function eightMarch()
    {
        $categories = Category::where('slug', '8march')->first();
        $products = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function set()
    {
        $brand = Brand::where('slug', 'sets')->first();
        $products = $brand->products()->live()->paginate(21);

        return view('web.sets', compact(['products', 'brand']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function discounts()
    {
        $products = Product::discount()->live()->paginate(21);

        return view('web.discounts', compact(['products']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contacts()
    {
        return view('web.contacts');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function bookmarks(Cart $bookmark)
    {
        $bookmarks = $bookmark->instance('bookmark')->content();

        return view('web.bookmark', compact('bookmarks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function confidentiality()
    {
        return view('web.confidentiality');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delivery()
    {
        return view('web.delivery');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sdek()
    {
        return view('web.sdek');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sdekPoints()
    {
        return view('web.sdek-points');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(Category $categories)
    {
        $products = $categories->products()->live()->orderBy('title_eng', 'asc')->paginate(21);

        return view('web.category', compact(['products', 'categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function subcategory(Category $categories, Subcategory $subcategory)
    {
        $products = $subcategory->products()->live()->orderBy('title_eng', 'asc')->paginate(21);

        return view('web.category', compact(['products', 'categories', 'subcategory']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function forKids()
    {
        return view('web.for-kids');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function success()
    {
        return view('web.status.success');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function failure()
    {
        return view('web.status.failure');
    }
}
