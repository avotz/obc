<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\Company;
use App\QuotationRequest;
use App\Quotation;

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
        $this->middleware('authByRole:partner')->except('checkPrivateCode');
        $this->userRepo = $userRepo;
    }

    
    public function users()
    {
        $company = auth()->user()->companies->first();

        $search['q'] = request('q');

        $users = $company->users()->with('profile')->search($search['q'])->paginate(10);

        return view('partner.users', compact('users','search'));
    }

     /**
     * Mostrar vista de editar informacion basica del medico
     */
     public function edit(User $user)
     {
        $company = auth()->user()->companies->first();

        if(!$company->isPartner($user)) return redirect('/partner/users');

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
        $company->fill($data);
        $company->save();

        $company->countries()->sync($data['country']);
        if(isset($data['sectors']))
            $company->sectors()->sync($data['sectors']);

        flash('Company Updated','success');
        
        return redirect()->back();
    }

    public function updatePrivateCode($partner_id)
    {
         $company = Company::find($partner_id);
         $company->private_code = request('private_code');
         $company->save();
         
         return $company;
    }

    public function checkPrivateCode($code)
    {
        $this->validate(request(),[
            'associate_private_code' => ['required', new Partner],  
        ]);
        
        return Company::where('private_code', $code)->with('countries')->first();
    }

     
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function requests()
    {
       

        $quotationRequests = auth()->user()->requests();

        
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);

       


        return view('requests.requests',compact('quotationRequests'));
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function userRequests(User $user)
    {
       

        $quotationRequests = $user->requests();

        
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);

       


        return view('partner.userRequests',compact('user','quotationRequests'));
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function userQuotations(User $user)
    {
      

            $quotations = Quotation::where('user_id',$user->id);
            $quotations = $quotations->paginate(10);

            return view('partner.userQuotations',compact('user','quotations'));

    
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function quotations()
    {
      

            $quotations = Quotation::where('user_id',auth()->id());
            $quotations = $quotations->paginate(10);

            return view('quotations.quotations',compact('quotations'));

    
    }

}
