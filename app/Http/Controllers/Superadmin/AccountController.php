<?php

namespace App\Http\Controllers\Superadmin;
use App\User;
use App\Country;
use App\Role;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:superadmin');
        $this->userRepo = $userRepo;
    }
    

  
    

     public function update($id)
     {
        $this->validate(request(), [
            'applicant_name' => 'required|string|max:255',
            'first_surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($id)],
            
            
        ]
        );

        $user = $this->userRepo->update($id, request()->all());
        
        flash('Profile Updated','success');
          
        return Redirect('/profile');
     }

     
   
   
   
}
