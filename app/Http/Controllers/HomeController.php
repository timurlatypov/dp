<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('landing-page');
    }

    /**
     * @return Factory|View
     */
    public function novelties()
    {
        $categories = Category::where('slug', 'new-products')->first();
        $products = Product::where('novelty', 1)->live()->paginate(21);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return Factory|View
     */
    public function bestsellers()
    {
        $categories = Category::where('slug', 'bestsellers')->first();
        $products = $categories->products()->live()->paginate(21);

        return view('web.template', compact(['products', 'categories']));
    }

    public function carePrograms()
    {
        $categories = Category::where('slug', 'care-programs')->first();
        $products = $categories->products()->live()->paginate(21);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return Factory|View
     */
    public function premium()
    {
        $categories = Category::where('slug', 'premium')->first();
        $products = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return Factory|View
     */
    public function fourteenthFeb()
    {
        $categories = Category::where('slug', '14feb')->first();
        $products = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return Factory|View
     */
    public function eightMarch()
    {
        $categories = Category::where('slug', '8march')->first();
        $products = $categories->products()->live()->paginate(20);

        return view('web.template', compact(['products', 'categories']));
    }

    /**
     * @return Factory|View
     */
    public function set()
    {
        $brand = Brand::where('slug', 'sets')->first();
        $products = $brand->products()->live()->paginate(21);

        return view('web.sets', compact(['products', 'brand']));
    }

    /**
     * @return Factory|View
     */
    public function discounts()
    {
        $products = Product::discount()->live()->paginate(21);

        return view('web.discounts', compact(['products']));
    }

    /**
     * @return Factory|View
     */
    public function contacts()
    {
        return view('web.contacts');
    }

    /**
     * @return Factory|View
     */
    public function bookmarks(Cart $bookmark)
    {
        $bookmarks = $bookmark->instance('bookmark')->content();

        return view('web.bookmark', compact('bookmarks'));
    }

    /**
     * @return Factory|View
     */
    public function confidentiality()
    {
        return view('web.confidentiality');
    }

    /**
     * @return Factory|View
     */
    public function delivery()
    {
        return view('web.delivery');
    }

    /**
     * @return Factory|View
     */
    public function sdek()
    {
        return view('web.sdek');
    }

    /**
     * @return Factory|View
     */
    public function sdekPoints()
    {
        return view('web.sdek-points');
    }

    /**
     * @return Factory|View
     */
    public function category(Category $categories)
    {
        $products = $categories->products()->live()->orderBy('title_eng', 'asc')->paginate(21);

        return view('web.category', compact(['products', 'categories']));
    }

    /**
     * @return Factory|View
     */
    public function subcategory(Category $categories, Subcategory $subcategory)
    {
        $products = $subcategory->products()->live()->orderBy('priority', 'desc')->paginate(21);

        return view('web.category', compact(['products', 'categories', 'subcategory']));
    }

    /**
     * @return Factory|View
     */
    public function forKids()
    {
        return view('web.for-kids');
    }

    /**
     * @return Factory|View
     */
    public function success()
    {
        return view('web.status.success');
    }

    /**
     * @return Factory|View
     */
    public function failure()
    {
        return view('web.status.failure');
    }
}
