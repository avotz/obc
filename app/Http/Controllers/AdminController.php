<?php

namespace App\Http\Controllers;
use App\User;
use App\Country;
use App\Company;
use App\Role;
use App\Sector;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:admin');
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

   

    
    public function users()
    {

        $search['q'] = request('q');
       

        $users = User::whereHas('roles', function($q){
             $q->where('name', 'partner');

        });

       

        $users = $users->whereHas('countries', function($q){
                $q->where('id',  auth()->user()->countries->first()->id);

        });
       
        
        $users = $users->search($search['q'])->paginate(10);
      


        return view('admin.users', compact('users','search'));
    }

     /**
     * Mostrar vista de editar informacion basica del medico
     */
     public function edit(User $user)
     {
       
        $roles = Role::where(function($q){
            $q->where('name', 'partner')
              ->orWhere('name', 'user');

       })->get();
        
       $sectors = Sector::get()->toTree();
        
         return view('admin.user',compact('user','roles','sectors'));
 
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
             'position_held' => 'required|string|max:255',
             'email' => ['required','email', Rule::unique('users')->ignore($id) ],
             
         ]
      );
         
         $user = $this->userRepo->update($id, request()->all());
 
         flash('Partner Updated','success');
         
         return redirect()->back();
         
     }

     public function updateCompany(Company $company)
     {
         $this->validate(request(), [
                     'activity' => 'required',
                     'phones' => 'required|string|max:255',
                     'physical_address' => 'required|string|max:255',
                     'country' => 'required',
                     'towns' => 'required|string|max:255',
                     'web_address' => 'required|string|max:255',
                     'legal_name' => 'required|string|max:255',
                     'legal_first_surname' => 'required|string|max:255',
                     'legal_second_surname' => 'required|string|max:255',
                     'legal_email' => 'required|string|email|max:255',
                 
                 ]
             );
         
         $data = request()->all();
         $company->fill($data);
         $company->save();
 
         $company->countries()->sync($data['country']);
         if(isset($data['sectors']))
             $company->sectors()->sync($data['sectors']);
 
         flash('Company Updated','success');
         
         return redirect()->back();
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
 
         return Redirect('/admin/users');
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
 
          return Redirect('/admin/users');
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

   
   
   
}
