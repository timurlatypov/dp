<?php

namespace App\Http\Controllers\Account;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

    public function profile()
    {
    	$user = User::select('name','surname', 'phone')->where('id', auth()->user()->id)->first();
        return view('account.pages.profile', compact('user'));
    }

    public function addresses()
    {
    	$addresses = auth()->user()->addresses()->get();

        return view('account.pages.addresses', compact('addresses'));
    }

    public function orders()
    {
    	$orders = auth()->user()->orders()->paginate(20);

        return view('account.pages.orders', compact('orders'));
    }

	public function favorites()
	{
		$favorites = auth()->user()->favorites()->paginate(20);

		return view('account.pages.favorite', compact('favorites'));
	}

	public function loyalty()
	{
		//$favorites = auth()->user()->favorites()->paginate(20);

		return view('account.pages.loyalty');
	}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
