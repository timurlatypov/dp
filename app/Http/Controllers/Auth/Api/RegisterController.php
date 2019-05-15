<?php

namespace App\Http\Controllers\Auth\Api;

use App\Notifications\UserRegistered;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function register(Request $request) {
		$validator = Validator::make(
			$request->only(['name', 'email', 'password']),
			[
				'name' => 'required|string|max:191',
				'email' => 'required|string|email|max:191|unique:users',
				'password' => 'required|string|min:6',
			],
			[
				'name.required' => 'Введите Имя',
				'email.unique' => 'Этот Email уже зарегистрирован',
				'password.required' => 'Укажите пароль',
				'password.min' => 'Не менее 6 символов',
			]);

		if ($validator->fails()) {
			return response()->json([
				'errors' => $validator->errors()
			], 405);
		}

		$user = User::create([
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => Hash::make($request['password']),
		]);

		$user->notify(new UserRegistered());

		return response()->json([
			'success' => 'OK'
		], 200);
	}
}
