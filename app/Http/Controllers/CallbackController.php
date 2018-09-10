<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CallbackController extends Controller
{
	public function store(Request $request, Mail $mail)
	{
		Mail::to(['info@doctorproffi.ru'])
			->bcc('timur.latypov@gmail.com')
			->send(new \App\Mail\Callback($request));

		return response([ 'data' => 'Успешно'], 200);
	}
}
