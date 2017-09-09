<?php

namespace App\Http\Controllers;
use App\User;
use App\Company;
use App\Country;
use App\Sector;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        $user->load('company.countries');
        if($user->hasRole('partner')){
            
            $sectors = Sector::get()->toTree();
            $countries = Country::all();

            return view('partner.profile', compact('user','sectors','countries'));
        }

        return view('user.profile', compact('user'));
    }

    /**
     * Guardar avatar del medico
     */
     public function avatar()
     {
         
         $mimes = ['jpg','jpeg','bmp','png'];
         $fileUploaded = "error";
        
         if(request()->file('photo'))
         {
         
             $file = request()->file('photo');
             $ext = $file->guessClientExtension();
            
             if(in_array($ext, $mimes))
                 $fileUploaded = $file->storeAs("avatars/". auth()->id(), "avatar.jpg",'public');
         }
 
         return $fileUploaded;
 
     }

    
}
