<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('checkPrivateCode');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('home');
    }

    public function checkPrivateCode($code)
    {
       
        return User::whereHas('roles', function($q){
            $q->where('name', 'partner');
        })->where('active', 1)
        ->where('private_code', $code)->first();
    }
}
