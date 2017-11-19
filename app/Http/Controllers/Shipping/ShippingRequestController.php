<?php

namespace App\Http\Controllers\Shipping;
use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\ShippingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ShippingRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:shipping');
      
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

        $shippingsRequests = ShippingRequest::with('quotation.user','user','shippings')->search($search['q'])->paginate(10);
      
        
        

        return view('shipping.shippings.index', compact('shippings','search'));
    
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShippingsRequests()
    {
        $search['q'] = request('q');

        $partner = auth()->user()->companies->first();

        $shippingsRequestsPublic = ShippingRequest::search($search['q'])->where('public',1)->with('quotation.user','user','shippings')->get()->all();
        
        $shippingsRequestsPrivate =  ShippingRequest::search($search['q'])->where('public', 0)->whereHas('suppliers', function($q) use($partner){
            $q->where('shipping_request_supplier.supplier_id', $partner->id);
        })->get()->all();

        $shippingsRequests = array_collapse([$shippingsRequestsPublic, $shippingsRequestsPrivate]);

       // dd($shippingsRequests);
      
         
        $paginator = paginate($shippingsRequests, 10);
          
        return $paginator; 
        
        

       
    
    }

       /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shippingRequest = ShippingRequest::find($id);
        
        $quotation = $shippingRequest->quotation;

        $partner = $quotation->user->companies->first();
        
        $user = $quotation->user->load('profile');
    


        return view('shipping.shippingsRequests.show', compact('user','partner','quotation','shippingRequest'));
    }


}
