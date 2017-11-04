<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\PurchaseOrder;
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
    public function index()
    {
      
        return 'index';
    
    }



      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quotation_id)
    {
        $quotation = Quotation::find($quotation_id);
        
        if($quotation->shipping) return redirect('/shippings/'.$quotation->shipping->id.'/edit');

        $partner =  $quotation->user->companies->first();

        $user =  $quotation->user->load('profile');

       



        return view('shippings.create', compact('user','partner','quotation'));
    }

    public function store($quotation_id)
    {

        $quotation = Quotation::find($quotation_id);
        
        $this->validate(request(), [
            'delivery_time' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'date' => 'required|date',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );
       
        $data = request()->all();

        $data['user_id'] = auth()->id();


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
        
        return redirect('requests/'.$quotation->request->id.'/quotations');
    }

      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = PurchaseOrder::find($id);
        
        $quotation = $purchase->quotation;

        $partner = $quotation->user->companies->first();
        
        $user = $quotation->user->load('profile');
    


        return view('purchases.edit', compact('user','partner','quotation','purchase'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'purchase_file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );

        $purchase = PurchaseOrder::find($id);
        $purchase->fill(request()->all());
        $purchase->save();


        $mimes = ['jpg','jpeg','bmp','png','pdf'];
        $fileUploaded = "error";

    
   
        if(request()->file('purchase_file'))
        {
        
            $file = request()->file('purchase_file');
           
            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');
            
        
        
            if(in_array($ext, $mimes)){
                
               

                $fileUploaded = $file->storeAs("purchases/". $purchase->id ."/files", $purchase->id.'-'.$onlyName.'.'.$ext,'public');

                $purchase->file = $purchase->id.'-'.$onlyName.'.'.$ext;
                $purchase->save();

               
            }
            
        }

      
   

       flash('Purchase order updated','success');
        


        return redirect('requests/'. $purchase->quotation->request->id.'/quotations');
    }

    public function deleteFilePurchase($id)
    {
        $directory= "purchases/". $id;
        $purchase = PurchaseOrder::find($id);
        $purchase->file = '';
        $purchase->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }
    public function update_status($id)
    {
            
            $purchase = \DB::table('purchase_orders')
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
