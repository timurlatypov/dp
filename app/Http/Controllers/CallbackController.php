<?php

namespace App\Http\Controllers;

use App\Mail\Callback;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class CallbackController extends Controller
{
    /**
     * @return Response|ResponseFactory
     */
    public function store(Request $request, Mail $mail)
    {
        Mail::to(['info@doctorproffi.ru'])
            ->bcc('timur.latypov@gmail.com')
            ->send(new Callback($request));

        return response(['data' => 'Успешно'], 200);
    }
}
