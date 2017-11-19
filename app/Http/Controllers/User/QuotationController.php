<?php

namespace App\Http\Controllers\User;
use App\User;
use App\Repositories\UserRepository;
use App\QuotationRequest;
use App\Quotation;
use App\CreditDays;

use App\Rules\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
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
      
            $user = auth()->user();
            $quotations =  $user->quotations()->paginate(10);
            

            return view('quotations.quotations',compact('quotations'));

    
    }


    
}
