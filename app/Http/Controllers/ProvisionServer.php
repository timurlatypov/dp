<?php

namespace App\Http\Controllers;

use App\Cart\Cart;

class ProvisionServer extends Controller
{
    public function index(Cart $cart): \Illuminate\Support\Collection
    {

        $cart->remove("b6d767d2f8ed5d21a44b0e5886680cb9");

        return $cart->getContent();
    }
}
