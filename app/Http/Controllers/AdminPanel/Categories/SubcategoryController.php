<?php

namespace App\Http\Controllers\AdminPanel\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function store(Category $categories, Request $request)
    {
        $subcategory = Subcategory::create([
            'slug' => $request->slug,
            'name' => $request->name,
            'title' => $request->title,
            'image_path' => $request->image_path,
            'body' => $request->body,
        ]);

        $categories->subcategories()->save($subcategory);

        return redirect()->back();
    }
}
