<?php

namespace App\Http\Controllers\AdminPanel\Categories;

use App\Categories;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoriesController extends Controller
{
    public function store(Categories $categories, Request $request)
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
