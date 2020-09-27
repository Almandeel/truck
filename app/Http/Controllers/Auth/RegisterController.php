<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Market;
use App\Company;
use App\Http\Controllers\Controller;
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
            'phone'     => ['required', 'string', 'max:10', 'unique:users'],
            'name'      => ['required', 'string', 'max:100'],
            'password'  => ['required', 'string', 'min:6'],
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
            'name'      => $data['name'],
            'address'   => $data['address'] ?? '',
            'phone'     => $data['phone'],
            'password'  => Hash::make($data['password']),
        ]);

        if(request()->type == 'company') {
            $company = Company::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

            $user->update([
                'company_id' => $company->id
            ]);

            $user->attachRole('company');

        }else {
            $user->attachRole('customer');
        }
        
        return $user;
    }
}
