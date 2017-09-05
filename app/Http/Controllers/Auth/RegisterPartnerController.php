<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterPartnerController extends Controller
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
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
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
            'company_name' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255',
            'activity' => 'required',
            'phones' => 'required|string|max:255',
            'physical_address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'towns' => 'required|string|max:255',
            'web_address' => 'required|string|max:255',
            'legal_name' => 'required|string|max:255',
            'legal_first_surname' => 'required|string|max:255',
            'legal_second_surname' => 'required|string|max:255',
            'legal_email' => 'required|string|email|max:255',
            'applicant_name' => 'required|string|max:255',
            'first_surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'position_held' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
       
        $data['role'] = Role::whereName('partner')->first();

        $user = $this->userRepo->store($data);
        
        return $user;
    }

     /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
     public function showRegistrationForm()
     {
 
         return view('auth.register-partner');
     }



}
