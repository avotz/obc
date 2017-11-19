<?php

namespace App\Http\Controllers\Superadmin;
use App\User;
use App\Country;
use App\Role;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
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
    

  
    public function create()
    {
        
        $roles = Role::where(function($q){
            $q->where('name', 'admin')
              ->orWhere('name', 'superadmin');

       })->get();

        return view('superadmin.users.create',compact('roles'));
    }

    public function store()
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
    public function index()
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
      


        return view('superadmin.users.index', compact('users','search'));
    }

     /**
     * Mostrar vista de editar informacion basica del medico
     */
     public function edit(User $user)
     {
       
        $roles = Role::all();
        
      /* $partners = User::whereHas('roles', function($q){
        $q->where('name', 'admin')
          ->orWhere('name', 'superadmin');

      });

  

       $partners = $partners->whereHas('countries', function($q) use ($user){
            $q->where('id', $user->countries->first()->id);

       })->count();*/
   
        
        
         return view('superadmin.users.edit',compact('user','roles'));
 
     }

    

     public function update($id)
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
    public function delete($id)
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