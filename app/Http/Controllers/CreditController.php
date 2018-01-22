<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\Credit;
use App\CreditRequest;
use Illuminate\Http\Request;
use App\Mail\StatusCredit;

class CreditController extends Controller
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
        $credits = $quotation->credits()->search($search['q'])->paginate(10);

        return view('creditRequests.index', compact('credits', 'quotation', 'search'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function creditsFromRequest($credit_request_id)
    {
        $search['q'] = request('q');
        $creditRequest = CreditRequest::find($credit_request_id);
        $credits = $creditRequest->credits()->with('quotation.user', 'user', 'creditRequest')->search($search['q'])->paginate(10);

        return view('credits.index', compact('credits', 'creditRequest', 'search'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCredits($quotation_id)
    {
        $search['q'] = request('q');
        $quotation = Quotation::find($quotation_id);
        $credits = $quotation->credits()->with('quotation.user', 'user', 'creditRequest')->search($search['q'])->paginate(10);

        return $credits;
    }

    /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credit = Credit::find($id);

        if ($credit->createdBy(auth()->user()) && auth()->user()->hasRole('credit')) {
            return redirect('/');
        }

        $quotation = $credit->quotation;

        $partner = $quotation->user->companies->first();

        $user = $quotation->user->load('profile');

        $creditsApproved = $quotation->credits()->where('status', 1)->first();

        return view('credits.edit', compact('user', 'partner', 'quotation', 'credit', 'creditsApproved'));
    }

    public function update_status($id)
    {
        // $credit = \DB::table('credits')
        //     ->where('id', $id)
        //     ->update(['status' => request('status')]); //no asistio a la cita
        $credit = Credit::find($id);
        $credit->status = request('status');
        $credit->save();

        try {
            \Mail::to([$credit->user->email])->send(new StatusCredit($credit));
        } catch (\Swift_TransportException $e) {  //Swift_RfcComplianceException
            \Log::error($e->getMessage());
        }

        return back();
    }

    /**
     * suppliers list for select.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function suppliers()
    {
         $creditCompanies = Company::search(request('q'))->whereHas('sectors', function ($q)
        {
            $q->whereIn('id',[60,61,62,63]); // shipping sectors

        })->get();
        //$suppliers = User::search(request('q'))->where('id','<>',auth()->id())->where('activity', 2)->where('active',1)->get();

        $itemsSelect = [];

        foreach($creditCompanies as $supplier)
        {
            $item = [
                "id"=> $supplier->id,
                "text"=> $supplier->public_code,
            ];

            $itemsSelect [] = $item;
        }

        return $itemsSelect;
    }*/
}
