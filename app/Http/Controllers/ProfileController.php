<?php

namespace App\Http\Controllers;
use App\User;
use App\Company;
use App\Country;
use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $company = $user->companies()->first();
        
        //$user->load('company.countries');
         if($user->hasRole('shipping')){
            
            $sectors = Sector::get()->toTree();

            return view('shipping.profile', compact('user','company','sectors'));
        }

        if($user->hasRole('partner')){
            
            $sectors = Sector::get()->toTree();

            return view('partner.profile', compact('user','company','sectors'));
        }
        if($user->hasRole('superadmin')){
            
          
            
            $admins =  User::count();

            return view('superadmin.profile', compact('user','admins'));
        }

        if($user->hasRole('admin')){
            
          
            
            $partners =  User::whereHas('roles', function($q){
                $q->where('name', 'partner');
   
           });
           $partners = $partners->whereHas('countries', function($q)use($user){
                $q->where('id', $user->countries->first()->id);

            })->count();

            return view('admin.profile', compact('user','partners'));
        }

        return view('user.profile', compact('user','company'));
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
      /**
     * Guardar avatar del medico
     */
     public function deleteAvatar($id)
     {
         $directory= "avatars/". $id;

         //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
         Storage::disk('public')->deleteDirectory($directory);
         
         return 'ok';
 
     }

    
}
