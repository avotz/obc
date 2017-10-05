<?php

namespace App\Http\Controllers;
use App\User;
use App\Country;
use App\Role;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
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
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('home');
    }

    public function create()
    {
        
        $roles = Role::where(function($q){
            $q->where('name', 'admin')
              ->orWhere('name', 'superadmin');

       })->get();

        return view('superadmin.create',compact('roles'));
    }

    public function storeUser()
    {

        $this->validate(request(), [
            'applicant_name' => 'required|string|max:255',
            'first_surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'email' => ['required','email','unique:users'],
            'password' => 'required|string|min:6',
            'role' => 'required',
            
        ]
        );
        $data = request()->all();
        $data['role'] = Role::where('id',$data['role'])->first();
       
        $user = $this->userRepo->store($data);

        flash('User Saved','success');
        
        return redirect('/superadmin/users');
    }
    public function users()
    {

        $search['q'] = request('q');
        $search['search_country'] = request('search_country');

        $users = User::where('id','<>', auth()->id());

        if($search['search_country']){

           $users = $users->whereHas('countries', function($q)use($search){
                 $q->where('id', $search['search_country']);

            });
        }
        
        $users = $users->search($search['q'])->paginate(10);
      


        return view('superadmin.users', compact('users','search'));
    }

     /**
     * Mostrar vista de editar informacion basica del medico
     */
     public function edit(User $user)
     {
       
        $roles = Role::where(function($q){
            $q->where('name', 'admin')
              ->orWhere('name', 'superadmin');

       })->get();
        
       $partners = User::whereHas('roles', function($q){
        $q->where('name', 'admin')
          ->orWhere('name', 'superadmin');

      });

  

       $partners = $partners->whereHas('countries', function($q) use ($user){
            $q->where('id', $user->countries->first()->id);

       })->count();
   
        
        
         return view('superadmin.user',compact('user','roles','partners'));
 
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

     public function updateUser($id)
     {
        $this->validate(request(), [
            'applicant_name' => 'required|string|max:255',
            'first_surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($id)],
            'role' => 'required',
            'country' => 'required',
            
        ]
        );

        $user = $this->userRepo->update($id, request()->all());
    
        flash('User updated','success');

          return Redirect('/superadmin/users');
     }
    
      /**
     * Active a user.
     *
     * @param  int $id
     *
     * @return Response
     */
     public function active(User $user)
     {
         $user->active = 1;
         $user->save();
        // $this->userRepo->update_active($id, 1);
 
         return Redirect('/superadmin/users');
     }
 
     /**
      * Inactive a user.
      *
      * @param  int $id
      *
      * @return Response
      */
     public function inactive(User $user)
     {
        $user->active = 0;
        $user->save();
 
          return Redirect('/superadmin/users');
     }

      /**
     * Eliminar consulta(cita)
     */
    public function deleteUser($id)
    {

        $user = $this->userRepo->destroy($id);

        flash('User Deleted','success');

        return back();

    }

    public function updateCountry($user_id)
    {
         $country = request('country_id');
         $admin = User::find($user_id);
         $admin->countries()->sync($country);
         //$admin->save();
         
         return $admin;
    }
   
   
}
