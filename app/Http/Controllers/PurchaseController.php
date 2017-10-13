<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
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
      

    
    }



      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quotation_id)
    {
        $quotation = Quotation::find($quotation_id);
        
        if($quotation->purchase) return redirect('/purchases/'.$quotation->purchase->id.'/edit');

        $partner =  $quotation->user->hasRole('partner') ? $quotation->user : $quotation->user->partners->first();
        $user =  $quotation->user->hasRole('user') ? $quotation->user->load('profile') : '';
    


        return view('purchases.create', compact('user','partner','quotation'));
    }

    public function store($quotation_id)
    {

        $quotation = Quotation::find($quotation_id);
        
        $this->validate(request(), [
            'purchase_file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );
       
        $data = request()->all();

        $data['user_id'] = auth()->id();
        $data['geo_type'] = $quotation->geo_type;

        $purchase = $quotation->purchase()->create($data);
        $purchase->generateTransactionId();



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
    
          
       

        flash('Purchase order Saved','success');
        
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

        $partner =  $quotation->user->hasRole('partner') ? $quotation->user : $quotation->user->partners->first();
        $user =  $quotation->user->hasRole('user') ? $quotation->user->load('profile') : '';
    


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
    
}
