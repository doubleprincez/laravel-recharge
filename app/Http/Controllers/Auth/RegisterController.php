<?php

namespace App\Http\Controllers\Auth;

use App\Events\EventCreateCredentials;
use App\Functions\ReferralFunction;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Webpatser\Uuid\Uuid;


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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'mobile'=>['required', 'string'],
            'gender'=>['required', 'string','size:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     * @throws \Exception
     */
    protected function create(array $data)
    {


        $wallet_id = Uuid::generate(1)->string;
        $ref_code =  md5(Uuid::generate(4)->string);



             $user= User::create([
                 'gender' => $data['gender'],
             'name' => $data['name'],
             'mobile' => $data['mobile'],
             'wallet_id' => $wallet_id,
             'referral_code'=> $ref_code,
             'email' => $data['email'],
             'password' => Hash::make($data['password'])
             ]);

         return $user;
    }
}
