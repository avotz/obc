<?php

namespace App\Http\Controllers\Shipping;
use App\User;
use App\Repositories\UserRepository;
use App\Company;
use App\QuotationRequest;
use App\Quotation;
use App\Role;

use App\Permission;
use App\Rules\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AccountController extends Controller
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
       

         if(isset($data['sectors'])){
                
                $company->sectors()->sync($data['sectors']);

                $shippingSectors = array_where($data['sectors'], function ($value, $key) {
                    return $value == 56 || $value == 57 || $value == 58 || $value == 59;
                });

                $roleShipping =  Role::whereName('shipping')->first();

                if(!$shippingSectors){

                    
                    auth()->user()->roles()->detach($roleShipping);
                     
                }
               
            }

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

   

}
