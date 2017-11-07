<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\Shipping;
use App\ShippingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ShippingController extends Controller
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
    public function index($quotation_id)
    {
        $search['q'] = request('q');
        $quotation = Quotation::find($quotation_id);
        $shippings = $quotation->shippings()->search($search['q'])->paginate(10);
        
        

        return view('shippings.index', compact('shippings','quotation','search'));
    
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShippings($quotation_id)
    {
        $search['q'] = request('q');
        $quotation = Quotation::find($quotation_id);
        $shippings = $quotation->shippings()->with('quotation.user','user')->search($search['q'])->paginate(10);
        
        
        

        return $shippings;
    
    }

   


      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($shippingRequest_id)
    {
        $shippingRequest = ShippingRequest::find($shippingRequest_id);
        
        $quotation = $shippingRequest->quotation;
        
        $partner =  $quotation->user->companies->first();

        $user =  $quotation->user->load('profile');

       



        return view('shippings.create', compact('user','partner','quotation','shippingRequest'));
    }

    public function store($shippingRequest_id)
    {
        $shippingRequest = ShippingRequest::find($shippingRequest_id);
        
        $quotation = $shippingRequest->quotation;
      
        
        $this->validate(request(), [
            'delivery_time' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'date' => 'required|date',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );
       
        $data = request()->all();

        $data['user_id'] = auth()->id();
        $data['shipping_request_id'] = $shippingRequest->id;

        $shipping = $quotation->shippings()->create($data);
        $shipping->generateTransactionId();



            $mimes = ['jpg','jpeg','bmp','png','pdf'];
            $fileUploaded = "error";
    
        
       
            if(request()->file('file'))
            {
            
                $file = request()->file('file');
               
                $name = $file->getClientOriginalName();
                $ext = $file->guessClientExtension();
                $onlyName = str_slug(pathinfo($name)['filename'], '-');
                
            
            
                if(in_array($ext, $mimes)){
                    
                   
    
                    $fileUploaded = $file->storeAs("shippings/". $shipping->id ."/files", $shipping->id.'-'.$onlyName.'.'.$ext,'public');
    
                    $shipping->file = $shipping->id.'-'.$onlyName.'.'.$ext;
                    $shipping->save();
    
                   
                }
                
            }
    
          
       

        flash('Shipping request Saved','success');
        
        return redirect('quotations/'.$quotation->id.'/shippings');
    }

      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = Shipping::find($id);
        
        $quotation = $shipping->quotation;

        $partner = $quotation->user->companies->first();
        
        $user = $quotation->user->load('profile');
    


        return view('shippings.edit', compact('user','partner','quotation','shipping'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );

        $shipping = shippingOrder::find($id);
        $shipping->fill(request()->all());
        $shipping->save();


        $mimes = ['jpg','jpeg','bmp','png','pdf'];
        $fileUploaded = "error";

    
   
        if(request()->file('file'))
        {
        
            $file = request()->file('file');
           
            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');
            
        
        
            if(in_array($ext, $mimes)){
                
               

                $fileUploaded = $file->storeAs("shippings/". $shipping->id ."/files", $shipping->id.'-'.$onlyName.'.'.$ext,'public');

                $shipping->file = $shipping->id.'-'.$onlyName.'.'.$ext;
                $shipping->save();

               
            }
            
        }

      
   

       flash('shipping order updated','success');
        


        return redirect('quotations/'. $shipping->quotation->id.'/shippings');
    }

    public function deleteFileshipping($id)
    {
        $directory= "shippings/". $id."/files";
        $shipping = Shipping::find($id);
        $shipping->file = '';
        $shipping->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }
    public function update_status($id)
    {
            
            $shipping = \DB::table('shippings')
            ->where('id', $id)
            ->update(['status' => request('status')]); //no asistio a la cita  

        return back();
    }

    /**
     * suppliers list for select.
     *
     * @return \Illuminate\Http\Response
     */
    public function suppliers()
    {
         $shippingCompanies = Company::search(request('q'))->whereHas('sectors', function ($q)
        {
            $q->whereIn('id',[56,57,58,59,4]); // shipping sectors

        })->get();
        //$suppliers = User::search(request('q'))->where('id','<>',auth()->id())->where('activity', 2)->where('active',1)->get();

        $itemsSelect = [];

        foreach($shippingCompanies as $supplier)
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