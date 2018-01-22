<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Company;
use App\Shipping;
use App\ShippingRequest;
use Illuminate\Http\Request;
use App\Mail\StatusShipping;

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
    public function index($quotation_id)
    {
        $search['q'] = request('q');
        $quotation = Quotation::find($quotation_id);
        $shippings = $quotation->shippings()->search($search['q'])->paginate(10);

        return view('shippingsRequests.index', compact('shippings', 'quotation', 'search'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function shippingsFromRequest($shipping_request_id)
    {
        $search['q'] = request('q');
        $shippingRequest = ShippingRequest::find($shipping_request_id);
        $shippings = $shippingRequest->shippings()->with('quotation.user', 'user', 'shippingRequest')->search($search['q'])->paginate(10);

        return view('shippings.index', compact('shippings', 'shippingRequest', 'search'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShippings($quotation_id)
    {
        $search['q'] = request('q');
        $quotation = Quotation::find($quotation_id);
        $shippings = $quotation->shippings()->with('quotation.user', 'user', 'shippingRequest')->search($search['q'])->paginate(10);

        return $shippings;
    }

    /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = Shipping::find($id);

        if ($shipping->createdBy(auth()->user()) && auth()->user()->hasRole('shipping')) {
            return redirect('/');
        }

        $quotation = $shipping->quotation;

        $partner = $quotation->user->companies->first();

        $user = $quotation->user->load('profile');

        $shippingsApproved = $quotation->shippings()->where('status', 1)->first();

        return view('shippings.edit', compact('user', 'partner', 'quotation', 'shipping', 'shippingsApproved'));
    }

    public function update_status($id)
    {
        // $shipping = \DB::table('shippings')
        //     ->where('id', $id)
        //     ->update(['status' => request('status')]); //se aprobo

        $shipping = Shipping::find($id);
        $shipping->status = request('status');
        $shipping->save();

        try {
            \Mail::to([$shipping->user->email])->send(new StatusShipping($shipping));
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
    public function suppliers()
    {
        $shippingCompanies = Company::search(request('q'))->whereHas('sectors', function ($q) {
            $q->whereIn('id', [56, 57, 58, 59]); // shipping sectors
        })->get();
        //$suppliers = User::search(request('q'))->where('id','<>',auth()->id())->where('activity', 2)->where('active',1)->get();

        $itemsSelect = [];

        foreach ($shippingCompanies as $supplier) {
            $item = [
                'id' => $supplier->id,
                'text' => $supplier->public_code,
            ];

            $itemsSelect[] = $item;
        }

        return $itemsSelect;
    }
}
