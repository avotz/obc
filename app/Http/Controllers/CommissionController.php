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
        if (!auth()->user()->hasPermission('view_commissions')) return redirect('/');

        $urlSearch = '/commissions/pending';
    
        $search['search_country'] = request('search_country');

        $commissions = $this->getCommissions(0, $search['search_country']);


        return view('commissions.index', compact('commissions','search', 'urlSearch'));
    }
    public function intransit()
    {
        if (!auth()->user()->hasPermission('view_commissions')) return redirect('/');
        
        $urlSearch = '/commissions/intransit';

        $search['search_country'] = request('search_country');

        $commissions = $this->getCommissions(1, $search['search_country']);


        return view('commissions.index', compact('commissions', 'search', 'urlSearch'));
    }
    public function paid()
    {
        if (!auth()->user()->hasPermission('view_commissions')) return redirect('/');

        $urlSearch = '/commissions/paid';

        $search['search_country'] = request('search_country');

        $commissions = $this->getCommissions(2, $search['search_country']);


        return view('commissions.index', compact('commissions', 'search', 'urlSearch'));
    }
    public function getCommissions($status = 0, $country_id = null)
    {
        $company = auth()->user()->companies->first();
       
        if (auth()->user()->hasRole('superadmin')){
            $country_id = ($country_id) ? $country_id : 1;
        } else {
            $country_id = ($country_id) ? $country_id : auth()->user()->countries->first()->id;
        }

        if ($company)
            $commissions = Commission::where('status', $status)->where('company_id', $company->id)->with('purchase.quotation.user.companies')->paginate(10);
        elseif($country_id)
            $commissions = Commission::where('status', $status)->where('country_id', $country_id)->with('purchase.quotation.user.companies')->paginate(10);
        else
            $commissions = Commission::where('status', $status)->with('purchase.quotation.user.companies')->paginate(10); 
        
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
