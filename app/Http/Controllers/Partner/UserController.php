<?php

namespace App\Http\Controllers\Partner;
use App\User;
use App\Repositories\UserRepository;
use App\Company;
use App\QuotationRequest;
use App\Quotation;

use App\Permission;
use App\Rules\Partner;
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
        $this->middleware('authByRole:partner');
        $this->userRepo = $userRepo;
    }

    
    public function index()
    {
        $company = auth()->user()->companies->first();

        $search['q'] = request('q');

        $users = $company->users()->with('profile')->search($search['q'])->paginate(10);

        return view('partner.users.index', compact('users','search'));
    }

     /**
     * Mostrar vista de editar informacion basica del medico
     */
     public function edit(User $user)
     {
        $company = auth()->user()->companies->first();

        if(!$company->isPartner($user)) return redirect('/partner/users');

        $permissions = Permission::all();

        
         return view('partner.users.edit',compact('user','permissions'));
 
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
    public function delete($id)
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
    /*public function requests()
    {
       

        $quotationRequests = auth()->user()->requests();

        
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);

       


        return view('requests.requests',compact('quotationRequests'));
    }*/
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function quotationRequests(User $user)
    {
       

        $quotationRequests = $user->requests();

        
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);

       


        return view('partner.users.quotationRequests',compact('user','quotationRequests'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function quotations()
    {
      

            $quotations = Quotation::where('user_id',auth()->id());
            $quotations = $quotations->paginate(10);

            return view('quotations.quotations',compact('quotations'));

    
    }*/

}
