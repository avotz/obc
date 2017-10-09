<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\QuotationRequest;
use App\Quotation;
use App\CreditDays;

use App\Rules\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuotationController extends Controller
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
    public function index($quotation_request_id)
    {
      

            $quotationRequest = QuotationRequest::find($quotation_request_id);
            $quotations = $quotationRequest->quotations();
            $quotations = $quotations->paginate(10);

            return view('quotations.index',compact('quotations'));
        



    
    }



      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quotation_request_id)
    {
        $quotationRequest = QuotationRequest::find($quotation_request_id);
        $user =  $quotationRequest->user->load('profile');
        
        $creditDays = CreditDays::all();

        return view('quotations.create', compact('user','creditDays','quotationRequest'));
    }

    public function store($quotation_request_id)
    {

        $quotationRequest = QuotationRequest::find($quotation_request_id);
        
        $this->validate(request(), [
            'delivery_time' => 'required|string|max:255',
            'way_of_delivery' => 'required|string|max:255',
            'way_to_pay' => 'required|string|max:255',
            'product_photo' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );
       
        $data = request()->all();

        $data['user_id'] = auth()->id();
        $data['geo_type'] = $quotationRequest->geo_type;

        $quotation =$quotationRequest->quotations()->create($data);
        $quotation->generateTransactionId();



            $mimes = ['jpg','jpeg','bmp','png','pdf'];
            $fileUploaded = "error";
    
        
       
            if(request()->file('product_photo'))
            {
            
                $file = request()->file('product_photo');
               
                $name = $file->getClientOriginalName();
                $ext = $file->guessClientExtension();
                $onlyName = str_slug(pathinfo($name)['filename'], '-');
                
            
            
                if(in_array($ext, $mimes)){
                    
                   
    
                    $fileUploaded = $file->storeAs("quotations/". $quotation->id ."/product", $quotation->id.'-'.$onlyName.'.'.$ext,'public');
    
                    $quotation->product_photo = $quotation->id.'-'.$onlyName.'.'.$ext;
                    $quotation->save();
    
                   
                }
                
            }
    
          
       

        flash('Quotation Saved','success');
        
        return redirect('/public/requests');
    }
    
}
