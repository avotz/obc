<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\Company;
use App\Permission;
use App\Rules\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PartnerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth')->except('checkPrivateCode');
        $this->userRepo = $userRepo;
    }

    
    public function users()
    {
        $partner = auth()->user();

        $search['q'] = request('q');

        $users = $partner->collaborators()->with('profile')->search($search['q'])->paginate(10);

        return view('partner.users', compact('users','search'));
    }

     /**
     * Mostrar vista de editar informacion basica del medico
     */
     public function edit(User $user)
     {
         $permissions = Permission::all();
        
         return view('partner.user',compact('user','permissions'));
 
     }
 
     /**
      * Actualizar informacion basica del medico
      */
     public function updatePermissions(User $user)
     {  
        // dd(request()->all());
         /*$this->validate(request(),[
                 'name' => 'required',
                 'email' => ['required','email', Rule::unique('users')->ignore(auth()->id()) ]
             ]);*/

         $user->permissions()->sync(request('permissions'));
         
 
         flash('Cuenta Actualizada','success');
 
         return Redirect('/partner/users/'.$user->id.'/edit');
 
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
 
         return Redirect('/partner/users');
     }
 
     /**
      * Inactive a user.
      *
      * @param  int $id
      *
      * @return Response
      */
     public function inactive($id)
     {
         $this->userRepo->update_active($id, 0);
 
          return Redirect('/partner/users');
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();

        return view('partner.profile', compact('user'));
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

        flash('Partner Updated','success');
        
        return redirect()->back();
        
    }
    /**
     * Guardar avatar del company
     */
     public function logoCompany()
     {
         
         $mimes = ['jpg','jpeg','bmp','png'];
         $fileUploaded = "error";
        
         if(request()->file('photo'))
         {
         
             $file = request()->file('photo');
             $ext = $file->guessClientExtension();
            
             if(in_array($ext, $mimes))
                 $fileUploaded = $file->storeAs("companies/". auth()->user()->company->id, "logo.jpg",'public');
         }
 
         return $fileUploaded;
 
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
        $countriesArray = $data['country'];
        $data['country'] = json_encode($data['country']);

        $company->fill($data);
        $company->save();

        $company->countries()->sync($countriesArray);

        flash('Company Updated','success');
        
        return redirect()->back();
    }

    public function updatePrivateCode($partner_id)
    {
         $partner = User::find($partner_id);
         $partner->private_code = request('private_code');
         $partner->save();
         
         return $partner;
    }

    public function checkPrivateCode($code)
    {
        $this->validate(request(),[
            'associate_private_code' => ['required', new Partner],  
        ]);
        
        return User::whereHas('roles', function($q){
            $q->where('name', 'partner');
        })->where('active', 1)
        ->where('private_code', $code)->with('company.countries')->first();
    }
}
