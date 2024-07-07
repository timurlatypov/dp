<?php

namespace App\Http\Middleware\V2\Cart;

use App\Cart\Cart;

class ResponseIfEmpty
{
    protected Cart $cart;
}
