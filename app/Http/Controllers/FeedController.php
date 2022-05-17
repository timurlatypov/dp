<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Menu;
use App\Product;

class FeedController extends Controller
{
    public function index()
    {
        $categories = Menu::all();
        $feedProducts = Product::getFeedProducts();

        return new Feed(
            $categories,
            $feedProducts,
            'feed.yml_catalog'
        );
    }

    public function addUniqueCategory($key, &$categories)
    {
        if (!array_key_exists($key, $categories)) {
            return $key;
        }
    }
}
