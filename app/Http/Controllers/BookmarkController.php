<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookmarkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return Response|ResponseFactory
     */
    public function store(Request $request, Cart $bookmark)
    {
        $bookmark->instance('bookmark')->add([
            'id' => $request->id,
            'name' => $request->title_eng,
            'qty' => 1,
            'price' => $request->price,
            'options' => [
                'discounted_price' => $request->discounted_price,
                'title_rus' => $request->title_rus,
                'discount' => $request->discount,
                'product_id' => $request->id,
                'product_slug' => $request->slug,
                'brand' => $request->brand['name'],
                'brand_slug' => $request->brand['slug'],
                'image' => $request->thumb_path,
            ],
        ]);

        return response(['data' => $bookmark->instance('bookmark')->content()], 200);
    }
}
