<?php

namespace App\Http\Controllers;
use App\User;
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
        
        if($user->hasRole('partner'))
            return view('partner.profile', compact('user'));

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
