<?php

namespace App\Http\Controllers\Billing\Postback;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostbackController extends Controller
{
    public function process(PaymentGateway $gateway, Request $request)
    {
        $queries = [];
        parse_str($request->getQueryString(), $queries);

        $checksum = $queries['checksum'];
        unset($queries['checksum']);


        ksort($queries);
        $flattened = $queries;
        array_walk($flattened, function(&$value, $key) {
            $value = "{$key};{$value}";
        });
        $string = implode(';', $flattened);


        $hmac = hash_hmac ( 'sha256' , $string , '');

        dd(strtoupper($hmac), $checksum);
    }

    public function check(Request $request)
    {
        Log::info('Alfabank postback', [
            'request' => $request->all(),
        ]);

        return response()->json('OK', 200);
    }
}
