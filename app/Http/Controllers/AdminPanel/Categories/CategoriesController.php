<?php

namespace App\Http\Controllers\AdminPanel\Categories;

use App\Categories;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        return view('admin.categories.index', compact(['categories']));
    }

    public function categoriesProducts(Categories $categories)
    {
        $category = $categories;

        return view('admin.categories.products', compact('category'));
    }

    public function subcategoriesProducts(Categories $categories, Subcategory $subcategory)
    {
        return view('admin.categories.subcategories.products', compact(['categories', 'subcategory']));
    }

    public function categoryAssociateProducts(Categories $categories, Request $request)
    {
        $products   = $request->toArray();
        $productsID = array_column($products, 'id');
        $categories->products()->sync($productsID);
    }

    public function subcategoryAssociateProducts(Categories $categories, Subcategory $subcategory, Request $request)
    {
        $products   = $request->toArray();
        $productsID = array_column($products, 'id');
        $subcategory->products()->sync($productsID);
    }
}
