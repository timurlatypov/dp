<?php

namespace App\Http\Controllers\AdminPanel\Design\Carousel;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
	public function index(Carousel $carousel)
	{
		$carousels = $carousel->all();
		return view('admin.design.carousel.index', compact('carousels'));
	}



	public function update (Request $request, Carousel $carousel)
	{
		$c = $request->toArray();

		$carousel->each(function ($banner, $index) use ($c) {
			$banner->update(array_only($c[$index], ['name', 'hex', 'image_path', 'order_id', 'link', 'title','body','brand','button','live','expired_at','deleted_at','created_at','updated_at']));
		});
	}
}
