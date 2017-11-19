<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\ShippingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ShippingRequestController extends Controller
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
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quotation_id)
    {
        $quotation = Quotation::find($quotation_id);
        
        $partner =  $quotation->user->companies->first();

        $user =  $quotation->user->load('profile');

       



        return view('shippingsRequests.create', compact('user','partner','quotation'));
    }

    public function store($quotation_id)
    {

        $quotation = Quotation::find($quotation_id);
        
        $this->validate(request(), [
            'delivery_time' => 'required|string|max:255',
            'date' => 'required|date',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );
       
        $data = request()->all();

        $data['user_id'] = auth()->id();


        $shippingRequest = $quotation->shippingsRequests()->create($data);
        $shippingRequest->generateTransactionId();

         if(!$shippingRequest->public && request('suppliers')){

            $shippingRequest->suppliers()->sync(request('suppliers'));
         }
        //  }else{
            
        //     $shippingCompaniesIds = Company::whereHas('sectors', function ($q)
        //     {
        //         $q->whereIn('id',[56,57,58,59]); // shipping sectors

        //     })->pluck('id');

        //     $shippingRequest->suppliers()->sync($shippingCompaniesIds);

        //  }



            $mimes = ['jpg','jpeg','bmp','png','pdf'];
            $fileUploaded = "error";
    
        
       
            if(request()->file('file'))
            {
            
                $file = request()->file('file');
               
                $name = $file->getClientOriginalName();
                $ext = $file->guessClientExtension();
                $onlyName = str_slug(pathinfo($name)['filename'], '-');
                
            
            
                if(in_array($ext, $mimes)){
                    
                   
    
                    $fileUploaded = $file->storeAs("shippings-requests/". $shippingRequest->id ."/files", $shippingRequest->id.'-'.$onlyName.'.'.$ext,'public');
    
                    $shippingRequest->file = $shippingRequest->id.'-'.$onlyName.'.'.$ext;
                    $shippingRequest->save();
    
                   
                }
                
            }
    
          
       

        flash('Shipping request Saved','success');
        
        return redirect('quotations/'.$quotation->id.'/shippings');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShippingsRequests($quotation_id)
    {
        $search['q'] = request('q');
        $quotation = Quotation::find($quotation_id);
        $shippingsRequests = $quotation->shippingsRequests()->with('quotation.user','user','shippings')->search($search['q'])->paginate(10);
        
        

        return $shippingsRequests;
    
    }

      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shippingRequest = ShippingRequest::find($id);
        
        $quotation = $shippingRequest->quotation;

        $partner = $quotation->user->companies->first();
        
        $user = $quotation->user->load('profile');
    


        return view('shippingsRequests.edit', compact('user','partner','quotation','shippingRequest'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );

        $shippingRequest = ShippingRequest::find($id);
        $shippingRequest->fill(request()->all());
        $shippingRequest->save();


        $mimes = ['jpg','jpeg','bmp','png','pdf'];
        $fileUploaded = "error";

    
   
        if(request()->file('file'))
        {
        
            $file = request()->file('file');
           
            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');
            
        
        
            if(in_array($ext, $mimes)){
                
               

                $fileUploaded = $file->storeAs("shippings-requests/". $shippingRequest->id ."/files", $shippingRequest->id.'-'.$onlyName.'.'.$ext,'public');

                $shippingRequest->file = $shippingRequest->id.'-'.$onlyName.'.'.$ext;
                $shippingRequest->save();

               
            }
            
        }

      
   

       flash('shipping order updated','success');
        


        return redirect('quotations/'. $shippingRequest->quotation->id.'/shippings');
    }

    public function deleteFileshipping($id)
    {
        $directory= "shippings-requests/". $id."/files";
        $shippingRequest = ShippingRequest::find($id);
        $shippingRequest->file = '';
        $shippingRequest->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }
    public function update_status($id)
    {
            
            $shippingRequest = \DB::table('shipping_requests')
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
            $q->whereIn('id',[56,57,58,59]); // shipping sectors

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

     /**
     * Eliminar consulta(cita)
     */
    public function destroy($id)
    {

        $shippingRequest = ShippingRequest::find($id)->delete();

        flash('Shipping Request Deleted','success');

        return back();

    }

    public function deleteFile($id)
    {
        $directory= "shippings-requests/". $id. "/files";
        $shippingRequest = ShippingRequest::find($id);
        $shippingRequest->file = '';
        $shippingRequest->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }

    
}
