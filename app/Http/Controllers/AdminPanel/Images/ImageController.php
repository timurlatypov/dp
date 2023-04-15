<?php

namespace App\Http\Controllers\AdminPanel\Images;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store_product_thumb()
    {
        $this->validate(request(), [
            'thumb' => ['required', 'image'],
        ]);

        request()->file('thumb')->storeAs('thumbs', request()->file('thumb')->getClientOriginalName(), 'public');

        return response(['data' => request()->file('thumb')->getClientOriginalName()], 200);
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store_product_image(Request $request)
    {
        $this->validate(request(), [
            'image' => ['required', 'image'],
        ]);

        $image_unique_name = uniqid('', true) . '-' . request()->file('image')->getClientOriginalName();

        request()->file('image')->storeAs($request->path, $image_unique_name, 'public');

        return response(['data' => $image_unique_name], 200);
    }
}
