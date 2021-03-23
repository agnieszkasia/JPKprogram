<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'first_name' => ['required','regex:/^[a-zA-Z]+$/u','string', 'max:255', 'min:2'],
            'family_name' => ['required', 'string', 'max:255', 'min:2'],
            'company' => ['required', 'string', 'max:255', 'min:2'],
            'street_name' => ['required', 'string', 'min:3', 'max:255'],
            'house_number' => ['required', 'string', 'max:255'],
            'postal_code' => ['required','regex:/[0-9]{2}-[0-9]{3}/u', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'regex:/[0-9]{10}/u', 'unique:users', 'size:10'],
            'birth_date' => ['required', 'string','regex:/[0-9]{2}\.[0-9]{2}\.19[0-9]{2}|200[0,1,2,3]/u', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        $user = User::create([
            'first_name' => $data['first_name'],
            'family_name' => $data['family_name'],
            'company' => $data['company'],
            'street_name' => $data['street_name'],
            'house_number' => $data['house_number'],
            'postal_code' => $data['postal_code'],
            'city' => $data['city'],
            'nip' => $data['nip'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $id = $user->id;

        Magazine::create([
            'user_id' => $id,
        ]);

        return $user;

    }
}
