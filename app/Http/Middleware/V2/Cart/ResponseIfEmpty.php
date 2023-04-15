<?php

namespace App\Http\Middleware\V2\Cart;

use App\Cart\Cart;
use Closure;
use Illuminate\Http\Request;

class ResponseIfEmpty
{
	protected Cart $cart;
}
