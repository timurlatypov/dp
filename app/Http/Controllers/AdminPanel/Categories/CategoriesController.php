<?php

namespace App\Http\Controllers\AdminPanel\Categories;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
    	$categories = Categories::all();
    	return view('admin.categories.index', compact(['categories']));
    }
}
