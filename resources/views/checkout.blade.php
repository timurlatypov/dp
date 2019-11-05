@extends('layouts.app')

@section('content')
    <div class="container px-0">
        <div class="row mx-0">
            <div class="col-12">
                <order-checkout-form
                        :session_cart="{{ $cart }}"
                        :session_cart_subtotal="{{ $subtotal }}"
                        :session_coupon="@if( session()->exists('coupon') ){{ session()->get('coupon') }}@else null @endif"
                        :auth_user="@if(auth()->check()) {{ auth()->user() }}@else null @endif"
                        :auth_user_addresses="@if( auth()->check() ) {{ auth()->user()->addresses }} @else null @endif"></order-checkout-form>
            </div>


        </div>
    </div>
@endsection
