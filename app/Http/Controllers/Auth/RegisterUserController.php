<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Repositories\UserRepository;
use App\Rules\Partner;
use App\Mail\NewUser;
use App\Mail\NewUserWelcome;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterUserController extends Controller
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
        $this->middleware('guest');
        $this->userRepo = $userRepo;
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
            'applicant_name' => 'required|string|max:255',
            'first_surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'position_held' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'associate_private_code' => ['required', new Partner],
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
        $partner = User::whereHas('roles', function($q){
                        $q->where('name', 'partner');
                    })->where('active', 1)
                    ->where('private_code', $data['associate_private_code'])
                    ->first();

        $data['role'] = Role::whereName('user')->first();
        
        
        $user = $this->userRepo->store($data);

        $user->addPartner($partner);

        try {
            
            \Mail::to($partner)->send(new NewUser($user));
            \Mail::to($user)->send(new NewUserWelcome($user));

        }catch (\Swift_TransportException $e)  //Swift_RfcComplianceException
        {
            \Log::error($e->getMessage());
        }
        
        
        
        return $user;
        
    }

     /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
     public function showRegistrationForm()
     {
 
         return view('auth.register-user');
     }



}
