<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function attachProductToFavorite(Product $product)
    {

        $user = auth()->user();

        if ($user->favorites->contains($product->id)) {
            return response(['message' => 'Уже сохранен'], 202);
        }

        auth()->user()->favorites()->attach($product->id);

        return response(['message' => 'Продукт сохранён как любимый!'], 200);

    }

    public function detachProductFromFavorite(Product $product)
    {

        $user = auth()->user();

        if ($user->favorites->contains($product->id)) {
            $user->favorites()->detach($product->id);

            return redirect()->back()->with('flash', 'Продукт удалён из Любимых');
        }

        return back();

    }
}
