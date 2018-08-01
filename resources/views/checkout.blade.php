@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">

                <order-checkout-form
                        :session_cart="{{ $cart }}"
                        :session_coupon="@if( session()->exists('coupon') ){{session()->get('coupon')}}@else null @endif"
                        :auth_user="@if( auth()->check() ){{auth()->user()}}@else null @endif"
                        :auth_user_addresses="@if( auth()->check() ){{ auth()->user()->addresses }}@else null @endif"
                        :session_cart_subtotal="{{ $subtotal }}"></order-checkout-form>

            </div>
        </div>
    </div>
@endsection