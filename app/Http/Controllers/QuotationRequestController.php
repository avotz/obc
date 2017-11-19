<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use App\Repositories\UserRepository;
use App\CreditDays;
use App\Sector;
use App\QuotationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
    public function public()
    {
       
        $quotationRequests = QuotationRequest::where('public', 1);

        
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
      
        $partner = auth()->user()->companies->first();
        
        $quotationRequests = QuotationRequest::where('public', 0)->whereHas('suppliers', function($q) use($partner){
            $q->where('request_supplier.supplier_id', $partner->id);
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
        $partner = auth()->user()->companies->first();
        // $creditDays = CreditDays::all();
        // $sectors = Sector::get()->toTree();
        // $deliveryDays = range(1, 100);
        return view('requests.create', compact('partner'));
    }

    public function store()
    {

        $this->validate(request(), [
            'sectors' => 'required',
            'delivery_time' => 'required|string|max:255',
            'way_of_delivery' => 'required|string|max:255',
            'way_to_pay' => 'required|string|max:255',
            'exp_date' => 'required|date',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            'product_photo' => 'mimes:jpeg,bmp,png',
            
            
            
        ]
        );
       

       // $quotationRequest = QuotationRequest::create(request()->all());

        $quotationRequest = auth()->user()->requests()->create(request()->all());
        
        $quotationRequest->generateTransactionId();

        if(request('suppliers'))
            $quotationRequest->suppliers()->sync(request('suppliers'));
        
        if(request('sectors'))
            $quotationRequest->sectors()->sync(request('sectors'));


            $mimes = ['jpg','jpeg','bmp','png'];
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
            
            $mimes = ['jpg','jpeg','bmp','png','pdf'];
            
            if(request()->file('file'))
            {
            
                $file = request()->file('file');
               
                $name = $file->getClientOriginalName();
                $ext = $file->guessClientExtension();
                $onlyName = str_slug(pathinfo($name)['filename'], '-');
                
            
            
                if(in_array($ext, $mimes)){
                    
                   
    
                    $fileUploaded = $file->storeAs("requests/". $quotationRequest->id ."/files", $quotationRequest->id.'-'.$onlyName.'.'.$ext,'public');
    
                    $quotationRequest->file = $quotationRequest->id.'-'.$onlyName.'.'.$ext;
                    $quotationRequest->save();
    
                   
                }
                
            }
    
          
       

        flash('Quotation Request Saved','success');
        
        return redirect('/public/requests');
    }

    /**
     * edit the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotationRequest = QuotationRequest::find($id);
        
        if(!$quotationRequest || !$quotationRequest->createdBy(auth()->user())) return redirect('/public/requests');

        $partner = auth()->user()->companies->first();
        // $creditDays = CreditDays::all();
        // $sectors = Sector::get()->toTree();
        // $deliveryDays = range(1, 100);

        return view('requests.edit', compact('partner','quotationRequest'));
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
            'exp_date' => 'required|date',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            'product_photo' => 'mimes:jpeg,bmp,png',
            
            
            
        ]
        );

        $quotationRequest = QuotationRequest::find($id);
        $quotationRequest->fill(request()->all());
        $quotationRequest->save();

        if(request('suppliers'))
            $quotationRequest->suppliers()->sync(request('suppliers'));

        if(request('sectors'))
            $quotationRequest->sectors()->sync(request('sectors'));


        $mimes = ['jpg','jpeg','bmp','png'];
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
        
        $mimes = ['jpg','jpeg','bmp','png','pdf'];

         if(request()->file('file'))
        {
        
            $file = request()->file('file');
           
            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');
            
        
        
            if(in_array($ext, $mimes)){
                
               

                $fileUploaded = $file->storeAs("requests/". $quotationRequest->id ."/files", $quotationRequest->id.'-'.$onlyName.'.'.$ext,'public');

                $quotationRequest->file = $quotationRequest->id.'-'.$onlyName.'.'.$ext;
                $quotationRequest->save();

               
            }
            
        }

      
   

    flash('Quotation Request updated','success');
        


        return redirect('/public/requests');
    }

    /**
     * suppliers list for select.
     *
     * @return \Illuminate\Http\Response
     */
    public function suppliers()
    {
         $suppliers = Company::search(request('q'))->where('activity', 2)->get();
        //$suppliers = User::search(request('q'))->where('id','<>',auth()->id())->where('activity', 2)->where('active',1)->get();

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

    public function deleteProductPhoto($id)
    {
        $directory= "requests/". $id."/product";
        $quotationRequest = QuotationRequest::find($id);
        $quotationRequest->product_photo = '';
        $quotationRequest->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }
    public function deleteFile($id)
    {
        $directory= "requests/". $id. "/files";
        $quotationRequest = QuotationRequest::find($id);
        $quotationRequest->file = '';
        $quotationRequest->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }
    

    


    
    
}
