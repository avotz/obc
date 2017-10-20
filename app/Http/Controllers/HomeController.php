<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\NewContact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->administrators = User::whereHas('roles', function ($query){
            $query->where('name',  'admin');
        })->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if(!auth()->user()->active){
            auth()->logout();
            return view('inactive-account');
        }

        return redirect('/profile');

        // if(auth()->user()->hasRole('partner'))
        //     return view('partner.home');

        // if(auth()->user()->hasRole('user')){
    
        //     return view('user.home');
        // }
        // if(auth()->user()->hasRole('superadmin')){
            
        //     return view('superadmin.home');
        // }

        // return view('home');
    }

    public function support()
    {
       
         return view('support.index');
    }

    public function sendSupport()
    {

        $this->validate(request(), [
            'firstname' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'msg' => 'required|string',

            
            
        ]
        );

        $dataMessage = request()->all();
        //dd($dataMessage);
        //$partner = User::find($dataMessage['partner']);
        //$user = User::find($dataMessage['user']);

        $dataMessage['user'] = auth()->user(); 

        try {
            
            \Mail::to($this->administrators)->send(new NewContact($dataMessage));
            
        
            flash('Message Sent','success');
            
           

        }catch (\Swift_TransportException $e)  //Swift_RfcComplianceException
        {
            \Log::error($e->getMessage());
        }

        return back();

    }
}
