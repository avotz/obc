<?php

namespace App\Http\Controllers\User;
use App\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\QuotationRequest;
use App\Quotation;
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
        $this->middleware('authByRole:user');
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

        flash('User Updated','success');
        
        return redirect()->back();
        
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
    public function quotations()
    {
      

            $quotations = Quotation::where('user_id',auth()->id());
            $quotations = $quotations->paginate(10);

            return view('quotations.quotations',compact('quotations'));

    
    }

   
}
