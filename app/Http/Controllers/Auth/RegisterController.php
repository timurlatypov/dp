<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Notifications\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ], [
        	'name.required' => 'Введите Имя',
        	'surname.required' => 'Введите Фамилию',
        	'phone.required' => 'Введите Телеофон',
        	'email.unique' => 'Этот Email уже зарегистрирован',
	        'password.required' => 'Укажите пароль',
	        'password.confirmed' => 'Пароли не совпадают',
	        'password.min' => 'Не менее 6 символов',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

    	$user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

	    $user->notify(new UserRegistered());

	    return $user;
    }
}
