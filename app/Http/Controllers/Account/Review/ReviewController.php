<?php

namespace App\Http\Controllers\Account\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\Review\CreateReviewRequest;
use App\Http\Requests\Account\Review\DeleteReviewRequest;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function show()
    {
        $authUser = auth()->user();

        $availableForReviewProducts = DB::table('user_order_products')
            ->select(
                'products.id as product_id',
                'products.title_rus as product_title_rus',
                'products.title_eng as product_title_eng',
                'products.slug as product_slug',
                'products.thumb_path as product_preview',
                'products.live as product_live',
                'products.brand_id as brand_id ',
                'brands.name as brand_name',
                'brands.slug as brand_slug'
            )
            ->where('user_id', $authUser->id)
            ->whereNotIn('product_id', function ($query) use ($authUser) {
                $query->select('product_id')
                    ->distinct()
                    ->from('reviews')
                    ->where('user_id', $authUser->id);
            })
            ->join('products', 'user_order_products.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->get();

        //        $productsWithReview = '';
        $productsWithReview = DB::table('reviews')
            ->select(
                'products.id as product_id',
                'products.title_rus as product_title_rus',
                'products.title_eng as product_title_eng',
                'products.slug as product_slug',
                'products.thumb_path as product_preview',
                'products.live as product_live',
                'products.brand_id as brand_id ',
                'brands.name as brand_name',
                'brands.slug as brand_slug',
                'reviews.stars as review_rating',
                'reviews.review as review_body',
                'reviews.published as review_is_published',
                'reviews.published_at as review_published_at',
            )
            ->where('user_id', $authUser->id)
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->get();

        return view('account.pages.reviews', compact('availableForReviewProducts', 'productsWithReview'));
    }

    public function create(CreateReviewRequest $request)
    {
        $user = auth()->user();

        Review::create([
            'stars' => $request->get('stars'),
            'review' => $request->get('comment'),
            'published' => false,
            'published_at' => now(),
            'user_id' => $user->id,
            'product_id' => $request->get('product_id')
        ]);

        return redirect()->back()->with('flash', 'Спасибо! Ваш отзыв будет опубликован после проверки.');
    }

    public function delete(DeleteReviewRequest $request): RedirectResponse
    {
        $authUser = auth()->user();

        $review = Review::where([
            'user_id' => $authUser->id,
            'product_id' => $request->get('product_id'),
        ])->first();

        $review->delete();

        return redirect()->back()->with('flash-error', 'Ваш отзыв удалён!');
    }

    public function parse()
    {
        $orders = Order::where('order_status', 'Доставлен')
            ->whereNotNull('user_id')
            ->get();

        foreach($orders as $order) {
            $details = json_decode($order->order_details);

            $data = array_map(function ($product) use ($order) {
                return ['user_id' => $order->user_id, 'order_id' => $order->id, 'product_id' => $product->id];
            }, $details);

            DB::table('user_order_products')->insertOrIgnore(
                $data
            );
        }
    }
}
