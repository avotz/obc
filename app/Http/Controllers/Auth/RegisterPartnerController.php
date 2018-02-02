<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Country;
use App\Sector;
use App\Repositories\UserRepository;
use App\Mail\NewPartner;
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
        $this->administrators = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $v = Validator::make($data, [
            'company_name' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255',
            'activity' => 'required',
            'phones' => 'required|string|max:255',
            'physical_address' => 'required|string|max:255',
            'country' => 'required',
            'towns' => 'required|string|max:255',
            //'web_address' => 'required|string|max:255',
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

        $v->sometimes('sectors', 'required', function ($input) {
            return $input->activity == 2;
        });

        return $v;
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

        try {
            \Mail::to($user)->send(new NewPartner($user));
        } catch (\Swift_TransportException $e) {  //Swift_RfcComplianceException
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
        //$sectors = Sector::whereNull('parent_id')->get();//Sector::with('descendants')->get();
        $sectors = Sector::get()->toTree();

        return view('auth.register-partner', compact('sectors'));
    }
}
