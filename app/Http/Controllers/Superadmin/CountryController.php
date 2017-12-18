<?php

namespace App\Http\Controllers\Superadmin;
use App\User;
use App\Country;
use App\Role;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CountryController extends Controller
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
        
        return view('superadmin.countries.create');
    }

    public function store()
    {

        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            
        ]
        );


        $country = Country::create(request()->all());

        flash('Country Saved','success');
        
        return redirect('/superadmin/countries');
    }

    public function index()
    {

        $search['q'] = request('q');
      

        
        $countries = Country::search($search['q'])->paginate(10);
      


        return view('superadmin.countries.index', compact('search','countries'));
    }

     /**
     * Mostrar vista de editar informacion basica del medico
     */
     public function edit(Country $country)
     {
       
         return view('superadmin.countries.edit',compact('country'));
 
     }

     
    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            
        ]
        );

         $country = Country::find($id);
         $country->fill(request()->all());
         $country->save();

         flash('Country updated','success');
         
         return redirect('/superadmin/countries');
    }

      /**
     * Eliminar consulta(cita)
     */
     public function delete($id)
     {
 
        $country = Country::find($id)->delete();
 
         flash('Country Deleted','success');
 
         return back();
 
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
