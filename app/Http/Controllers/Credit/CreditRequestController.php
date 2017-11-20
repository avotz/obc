<?php

namespace App\Http\Controllers\Credit;
use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\CreditRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class CreditRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:credit');
      
        $this->userRepo = $userRepo;
    }

   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search['q'] = request('q');

        $creditRequests = CreditRequest::with('quotation.user','user','credits')->search($search['q'])->paginate(10);
      
        
        

        return view('credit.credits.index', compact('credits','search'));
    
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreditRequests()
    {
        $search['q'] = request('q');

        $partner = auth()->user()->companies->first();

        $creditRequests = CreditRequest::search($search['q'])->with('quotation.user','user','credits')->paginate(10);

        return $creditRequests;
        /*$creditRequestsPublic = CreditRequest::search($search['q'])->where('public',1)->with('quotation.user','user','shippings')->get()->all();
        
        $creditRequestsPrivate =  CreditRequest::search($search['q'])->where('public', 0)->whereHas('suppliers', function($q) use($partner){
            $q->where('shipping_request_supplier.supplier_id', $partner->id);
        })->get()->all();

        $creditRequests = array_collapse([$creditRequestsPublic, $creditRequestsPrivate]);

       // dd($creditRequests);
      
         
        $paginator = paginate($creditRequests, 10);
          
        return $paginator; */
        
        

       
    
    }

       /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditRequest = CreditRequest::find($id);
        
        $quotation = $creditRequest->quotation;

        $partner = $quotation->user->companies->first();
        
        $user = $quotation->user->load('profile');
    


        return view('credit.creditRequests.show', compact('user','partner','quotation','creditRequest'));
    }


}
