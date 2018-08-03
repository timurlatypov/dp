<?php

namespace App\Http\Controllers;

use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$cart  = Cart::content();
        return view('landing-page', compact('cart'));
    }

    public function show($id)
    {
    	$user = User::find($id);
    	dd($user);
    }
}
