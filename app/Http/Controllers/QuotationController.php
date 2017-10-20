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
use Illuminate\Support\Facades\Storage;

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
            if(!$quotationRequest->createdBy(auth()->user())) return redirect('/public/requests');
            

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
        $partner =  $quotationRequest->user->hasRole('partner') ? $quotationRequest->user : $quotationRequest->user->partners->first();
        $user =  $quotationRequest->user->hasRole('user') ? $quotationRequest->user->load('profile') : '';
    
        $creditDays = CreditDays::all();

        return view('quotations.create', compact('user','partner','creditDays','quotationRequest'));
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

    /**
     * edit the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotation = Quotation::find($id);

        if(!$quotation->createdBy(auth()->user())) return redirect('/public/requests');

        $quotationRequest = $quotation->request;

        $partner =  $quotationRequest->user->hasRole('partner') ? $quotationRequest->user : $quotationRequest->user->partners->first();
        $user =  $quotationRequest->user->hasRole('user') ? $quotationRequest->user->load('profile') : '';

        $creditDays = CreditDays::all();

        return view('quotations.edit', compact('user','partner','creditDays','quotation','quotationRequest'));
    }
    /**
     * update the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'delivery_time' => 'required|string|max:255',
            'way_of_delivery' => 'required|string|max:255',
            'way_to_pay' => 'required|string|max:255',
            'product_photo' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );

        $quotation = Quotation::find($id);
        $quotation->fill(request()->all());
        $quotation->save();


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

      
   

    flash('Quotation updated','success');
        


        return redirect('/quotations/'.$quotation->id .'/edit');
    }

    public function deleteProductPhoto($id)
    {
        $directory= "quotations/". $id;
        $quotation = Quotation::find($id);
        $quotation->product_photo = '';
        $quotation->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }


    
}
