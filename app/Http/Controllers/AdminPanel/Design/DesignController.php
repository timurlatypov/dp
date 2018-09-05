<?php

namespace App\Http\Controllers\AdminPanel\Design;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignController extends Controller
{
    public function index()
    {
    	return view('admin.design.index');
    }
}
