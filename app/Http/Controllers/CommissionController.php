<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Commission;

class CommissionController extends Controller
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
    public function pending()
    {
        $commissions = $this->getCommissions(0);


        return view('commissions.index', compact('commissions'));
    }
    public function intransit()
    {
        $commissions = $this->getCommissions(1);


        return view('commissions.index', compact('commissions'));
    }
    public function paid()
    {
        
        $commissions = $this->getCommissions(2);


        return view('commissions.index', compact('commissions'));
    }
    public function getCommissions($status = 0)
    {
        $company = auth()->user()->companies->first();
        $country = auth()->user()->countries->first();

        if ($company)
            $commissions = Commission::where('status', $status)->where('company_id', $company->id)->with('purchase.quotation.user.companies')->paginate(10);
        else
            $commissions = Commission::where('status', $status)->where('country_id', $country->id)->with('purchase.quotation.user.companies')->paginate(10); 
        
        return $commissions;
    }
    
    public function update_status($id)
    {
        $purchase = \DB::table('commissions')
            ->where('id', $id)
            ->update(['status' => request('status')]); //no asistio a la cita

        return back();
    }
}
