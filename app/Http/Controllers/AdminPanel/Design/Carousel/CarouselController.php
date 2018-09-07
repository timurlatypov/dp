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

	public function create()
	{
		return view('admin.design.carousel.create');
	}

	public function store(Request $request)
	{
		$banner = Carousel::create([
			'body' => $request->body,
			'body_hex' => $request->body_hex,
			'brand' => $request->brand,
			'button' => $request->button,
			'hex' => $request->hex,
			'image_path' => $request->image_path,
			'link' => $request->link,
			'order_id' => $request->order_id,
			'title' => $request->title,
			'title_hex' => $request->title_hex,
			'expired_at' => $request->expired_at
		]);
	}

	public function store_image(Request $request)
	{
		$this->validate(request(), [
			'image' => ['required', 'image']
		]);

		$image_unique_name = uniqid().'-'.request()->file('image')->getClientOriginalName();

		$image = request()->file('image')->storeAs($request->path, $image_unique_name, 'public');

		return response(['data' => $image_unique_name], 200);
	}


	public function update (Request $request, Carousel $carousel)
	{
		$c = $request->toArray();

		$carousel->each(function ($banner, $index) use ($c) {
			$banner->update(array_only($c[$index], ['name', 'hex', 'image_path', 'order_id', 'link', 'title','body','brand','button','live','expired_at','deleted_at','created_at','updated_at']));
		});
	}

	public function toggle(Request $request)
	{
		if ($request->checked) {
			$checked = 1;
		} else {
			$checked = 0;
		}

		$carousel = Carousel::find($request->id);
		$carousel->update(['live' => $checked]);

	}
}
