<?php

namespace App\Http\Controllers;

use App\Mail\Callback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CallbackController extends Controller
{
	public function store(Request $request, Mail $mail)
	{
		Mail::to(['info@doctorproffi.ru'])
			->bcc('timur.latypov@gmail.com')
			->send(new Callback($request));

		return response([ 'data' => 'Успешно'], 200);
	}
}
