<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Company;
use App\Repositories\UserRepository;
use App\CreditDays;
use App\Sector;
use App\QuotationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class QuotationRequestController extends Controller
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

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $quotationRequests = auth()->user()->requests();

      
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);


        return view('requests.requests',compact('quotationRequests'));
    }

   
    
    


    
    
}
