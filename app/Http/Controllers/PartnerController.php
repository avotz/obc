<?php

namespace App\Http\Controllers;
use App\User;
use App\Company;
use App\Rules\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('checkPrivateCode');
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

    public function updateCompany(Company $company)
    {
        $this->validate(request(), [
                    'activity' => 'required',
                    'phones' => 'required|string|max:255',
                    'physical_address' => 'required|string|max:255',
                    'country' => 'required',
                    'towns' => 'required|string|max:255',
                    'web_address' => 'required|string|max:255',
                
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
        ->where('private_code', $code)->with('company')->first();
    }
}
