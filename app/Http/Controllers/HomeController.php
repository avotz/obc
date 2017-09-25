<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        if(auth()->user()->hasRole('partner'))
            return view('partner.home');

        if(auth()->user()->hasRole('user')){
    
            return view('user.home');
        }
        if(auth()->user()->hasRole('superadmin')){
            
            return view('superadmin.home');
        }

        return view('home');
    }
}
