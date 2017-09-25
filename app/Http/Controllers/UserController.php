<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:user');
        $this->userRepo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('home');
    }

    public function update($id)
    {
        $this->validate(request(), [
            'applicant_name' => 'required|string|max:255',
            'first_surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'position_held' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($id) ],
            
        ]
    );
        
        $user = $this->userRepo->update($id, request()->all());

        flash('User Updated','success');
        
        return redirect()->back();
        
    }

   
}
