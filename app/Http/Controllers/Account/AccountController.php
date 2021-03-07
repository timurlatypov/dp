<?php

namespace App\Http\Controllers\Account;

use App\User;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function profile()
    {
        $user = User::select('name', 'surname', 'phone')->where('id', auth()->user()->id)->first();

        return view('account.pages.profile', compact('user'));
    }

    public function profile_update(ProfileUpdateRequest $request)
    {
        auth()->user()->update([
            'name'    => $request->name,
            'surname' => $request->surname,
            'phone'   => $request->phone,
        ]);

        return redirect()->back()->with('flash', 'Информация обновлена');
    }


    public function addresses()
    {
        $addresses = auth()->user()->addresses()->get();

        return view('account.pages.addresses', compact('addresses'));
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(20);

        return view('account.pages.orders', compact('orders'));
    }

    public function favorites()
    {
        $favorites = auth()->user()->favorites()->paginate(20);

        return view('account.pages.favorite', compact('favorites'));
    }

    public function loyalty()
    {
        $user = auth()->user();

        return view('account.pages.loyalty', compact(['user']));
    }
}
