<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Billing Credentials
    |
    | Documentation: https://pay.alfabank.ru/ecommerce/instructions/merchantManual/pages/index/plugins.html
    | Requirements: https://payment.alfabank.ru/ecommerce/instructions/merchantManual/pages/site_req.html
    | Connection: https://payment.alfabank.ru/ecommerce/faq/connection2.html
    |--------------------------------------------------------------------------
    |
    */
    'alfabank' => [
        'username' => env('ALFABANK_API_USERNAME', ''),
        'password' =>  env('ALFABANK_API_PASSWORD', ''),
        'gateway' =>  env('ALFABANK_API_GATEWAY_URL', ''),
        'postback' =>  env('ALFABANK_POSTBACK_URL', ''),
    ]
];