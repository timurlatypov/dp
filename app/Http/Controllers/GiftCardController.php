<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GiftCardController extends Controller
{
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return Response|ResponseFactory
     */
    public function cancel()
    {
        request()->session()->forget('gift_card');

        return response(['cart' => $this->cart->content()], 200);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function apply(Request $request)
    {
        $giftCard = GiftCard::where([
            ['code', '=', $request->get('code')],
            ['expired_at', '>', now()],
            ['used', '=', 0],
        ])->first();

        if (empty($giftCard)) {
            return response([
                'message' => 'Подарочная карта недействительна',
            ], 202);
        }

        $request->session()->put('gift_card', $giftCard);

        return response([
            'gift_card' => $giftCard,
            'cart' => $this->cart->content(),
        ], 200);
    }
}
