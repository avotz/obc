<?php

namespace App\Http\Controllers;
use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\CreditRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CreditRequestController extends Controller
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

       



        return view('creditRequests.create', compact('user','partner','quotation'));
    }

    public function store($quotation_id)
    {

        $quotation = Quotation::find($quotation_id);
        
        $this->validate(request(), [
        
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'credit_time' => 'required|numeric',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );
       
        $data = request()->all();

        $data['user_id'] = auth()->id();


        $creditRequest = $quotation->creditRequests()->create($data);
        $creditRequest->generateTransactionId();

         /*if(!$creditRequest->public && request('suppliers')){

            $creditRequest->suppliers()->sync(request('suppliers'));
         }*/
       



            $mimes = ['jpg','jpeg','bmp','png','pdf'];
            $fileUploaded = "error";
    
        
       
            if(request()->file('file'))
            {
            
                $file = request()->file('file');
               
                $name = $file->getClientOriginalName();
                $ext = $file->guessClientExtension();
                $onlyName = str_slug(pathinfo($name)['filename'], '-');
                
            
            
                if(in_array($ext, $mimes)){
                    
                   
    
                    $fileUploaded = $file->storeAs("credit-requests/". $creditRequest->id ."/files", $creditRequest->id.'-'.$onlyName.'.'.$ext,'public');
    
                    $creditRequest->file = $creditRequest->id.'-'.$onlyName.'.'.$ext;
                    $creditRequest->save();
    
                   
                }
                
            }
    
          
       

        flash('Credit request Saved','success');
        
        return redirect('quotations/'.$quotation->id.'/credits');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreditRequests($quotation_id)
    {
        $search['q'] = request('q');
        $quotation = Quotation::find($quotation_id);
        $creditRequests = $quotation->creditRequests()->with('quotation.user','user','credits')->search($search['q'])->paginate(10);
        
        

        return $creditRequests;
    
    }

      /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $creditRequest = CreditRequest::find($id);
        
        $quotation = $creditRequest->quotation;

        $partner = $quotation->user->companies->first();
        
        $user = $quotation->user->load('profile');
    


        return view('creditRequests.edit', compact('user','partner','quotation','creditRequest'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'credit_time' => 'required|numeric',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            
            
            
        ]
        );

        $creditRequest = CreditRequest::find($id);
        $creditRequest->fill(request()->all());
        $creditRequest->save();


        $mimes = ['jpg','jpeg','bmp','png','pdf'];
        $fileUploaded = "error";

    
   
        if(request()->file('file'))
        {
        
            $file = request()->file('file');
           
            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');
            
        
        
            if(in_array($ext, $mimes)){
                
               

                $fileUploaded = $file->storeAs("credit-requests/". $creditRequest->id ."/files", $creditRequest->id.'-'.$onlyName.'.'.$ext,'public');

                $creditRequest->file = $creditRequest->id.'-'.$onlyName.'.'.$ext;
                $creditRequest->save();

               
            }
            
        }

      
   

       flash('Credit order updated','success');
        


        return redirect('quotations/'. $creditRequest->quotation->id.'/credits');
    }

    public function deleteFileshipping($id)
    {
        $directory= "credit-requests/". $id."/files";
        $creditRequest = CreditRequest::find($id);
        $creditRequest->file = '';
        $creditRequest->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }
    public function update_status($id)
    {
            
            $creditRequest = \DB::table('credit_requests')
            ->where('id', $id)
            ->update(['status' => request('status')]); //no asistio a la cita  

        return back();
    }

    /**
     * suppliers list for select.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function suppliers()
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
    }*/

     /**
     * Eliminar consulta(cita)
     */
    public function destroy($id)
    {

        $creditRequest = CreditRequest::find($id)->delete();

        flash('Credit Request Deleted','success');

        return back();

    }

    public function deleteFile($id)
    {
        $directory= "credit-requests/". $id. "/files";
        $creditRequest = CreditRequest::find($id);
        $creditRequest->file = '';
        $creditRequest->save();
        
        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);
        
        return 'ok';
         
    }

    
}
