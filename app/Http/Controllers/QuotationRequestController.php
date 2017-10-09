<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UserRepository;
use App\CreditDays;
use App\QuotationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuotationRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
       
        $this->userRepo = $userRepo;
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $search['q'] = request('q');
        //$search['search_country'] = request('search_country');

        $quotationRequests = auth()->user()->requests();

        /*if($search['search_country']){

           $quotationRequests = $quotationRequests->whereHas('countries', function($q)use($search){
                 $q->where('id', $search['search_country']);

            });
        }*/
        
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);

       


        return view('partner.requests',compact('quotationRequests'));
    }
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function public()
    {
       // $search['q'] = request('q');
        //$search['search_country'] = request('search_country');

        $quotationRequests = QuotationRequest::where('public', 1);

        /*if($search['search_country']){

           $quotationRequests = $quotationRequests->whereHas('countries', function($q)use($search){
                 $q->where('id', $search['search_country']);

            });
        }*/
        
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);

       


        return view('requests.index',compact('quotationRequests'));
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function private()
    {
      

        
        $quotationRequests = QuotationRequest::where('public', 0)->whereHas('suppliers', function($q){
            $q->where('request_supplier.user_id', auth()->id());
        });
      

    
        
        $quotationRequests = $quotationRequests->orderBy('created_at','DESC')->paginate(10);

       


        return view('requests.index',compact('quotationRequests'));
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $creditDays = CreditDays::all();

        return view('requests.create', compact('user','creditDays'));
    }

    public function store()
    {

        $this->validate(request(), [
            'delivery_time' => 'required|string|max:255',
            'way_of_delivery' => 'required|string|max:255',
            'way_to_pay' => 'required|string|max:255',
            'exp_date' => 'required|date',
            'product_photo' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );
       

       // $quotationRequest = QuotationRequest::create(request()->all());

        $quotationRequest = auth()->user()->requests()->create(request()->all());
        
        $quotationRequest->generateTransactionId();

        if(request('suppliers'))
            $quotationRequest->suppliers()->sync(request('suppliers'));


            $mimes = ['jpg','jpeg','bmp','png','pdf'];
            $fileUploaded = "error";
    
        
       
            if(request()->file('product_photo'))
            {
            
                $file = request()->file('product_photo');
               
                $name = $file->getClientOriginalName();
                $ext = $file->guessClientExtension();
                $onlyName = str_slug(pathinfo($name)['filename'], '-');
                
            
            
                if(in_array($ext, $mimes)){
                    
                   
    
                    $fileUploaded = $file->storeAs("requests/". $quotationRequest->id ."/product", $quotationRequest->id.'-'.$onlyName.'.'.$ext,'public');
    
                    $quotationRequest->product_photo = $quotationRequest->id.'-'.$onlyName.'.'.$ext;
                    $quotationRequest->save();
    
                   
                }
                
            }
    
          
       

        flash('Quotation Request Saved','success');
        
        return redirect('/public/requests');
    }

    /**
     * suppliers list for select.
     *
     * @return \Illuminate\Http\Response
     */
    public function suppliers()
    {
        $suppliers = User::search(request('q'))->where('id','<>',auth()->id())->where('activity', 2)->where('active',1)->get();

        $itemsSelect = [];

        foreach($suppliers as $supplier)
        {
            $item = [
                "id"=> $supplier->id,
                "text"=> $supplier->public_code,
            ];

            $itemsSelect [] = $item;
        }

        return $itemsSelect;
    }


    
    
}
