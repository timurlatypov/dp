<?php

namespace App\Http\Controllers\AdminPanel\Categories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact(['categories']));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function categoriesProducts(Category $categories)
    {
        $category = $categories;

        return view('admin.categories.products', compact('category'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function subcategoriesProducts(Category $categories, Subcategory $subcategory)
    {
        return view('admin.categories.subcategories.products', compact(['categories', 'subcategory']));
    }

    public function categoryAssociateProducts(Category $categories, Request $request): void
    {
        $products   = $request->toArray();
        $productsID = array_column($products, 'id');
        $categories->products()->sync($productsID);
    }

    public function subcategoryAssociateProducts(Category $categories, Subcategory $subcategory, Request $request): void
    {
        $products   = $request->toArray();
        $productsID = array_column($products, 'id');
        $subcategory->products()->sync($productsID);
    }
}
