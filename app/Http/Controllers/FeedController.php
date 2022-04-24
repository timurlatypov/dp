<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Models\Feed;
use App\Product;
use App\Subcategory;

class FeedController extends Controller
{
    public function index()
    {
        $feedProducts = Product::getFeedProducts();
        $categories = Categories::whereIn('id', ['2','3','6'])->get();

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
