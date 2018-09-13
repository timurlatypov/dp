<?php

namespace App\Http\Controllers\AdminPanel\Images;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
	public function store_product_thumb()
	{
		$this->validate(request(), [
			'thumb' => ['required', 'image']
		]);

		$thumb = request()->file('thumb')->storeAs('thumbs', request()->file('thumb')->getClientOriginalName(), 'public');

		return response(['data' => request()->file('thumb')->getClientOriginalName()], 200);

	}


	public function store_product_image(Request $request)
	{

		$this->validate(request(), [
			'image' => ['required', 'image']
		]);

		$image_unique_name = uniqid().'-'.request()->file('image')->getClientOriginalName();

		$image = request()->file('image')->storeAs($request->path, $image_unique_name, 'public');


		return response(['data' => $image_unique_name], 200);
	}
}
