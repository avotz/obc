<?php

namespace App\Http\Controllers\Superadmin;
use App\User;
use App\Country;
use App\Company;
use App\Role;
use App\Sector;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Shipping;
use App\ShippingRequest;
use App\CreditRequest;
use App\Credit;
use App\Quotation;
use App\QuotationRequest;
use App\PurchaseOrder;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:superadmin');
        $this->userRepo = $userRepo;
    }
    


    
    public function index()
    {

        $search['q'] = request('q');
       

       
        $countries = Country::all();
       
        
    

        return view('superadmin.transactions.index', compact('countries','search'));
    }

    public function getQuotations()
    {
        $search['q'] = request('q');
        $country_id = request('country');

        $date_start = request('date_start') ? Carbon::parse(request('date_start')) : Carbon::now();
        $date_end = request('date_end') ? Carbon::parse(request('date_end')) : Carbon::now();

        $quotations = Quotation::where([
            ['created_at', '>=', $date_start],
            ['created_at', '<=', $date_end->endOfDay()]
        ])->where('country_id', $country_id)->with('request.user', 'user.profile')->search($search['q'])->paginate(10);




        return $quotations;

    }

    public function getQuotationRequests()
    {
        $search['q'] = request('q');
        $country_id = request('country');

        $date_start = request('date_start') ? Carbon::parse(request('date_start')) : Carbon::now();
        $date_end = request('date_end') ? Carbon::parse(request('date_end')) : Carbon::now();
        
      
        $quotationRequests = QuotationRequest::where([
            ['created_at', '>=', $date_start],
            ['created_at', '<=', $date_end->endOfDay()]
        ])->where('country_id', $country_id)->with('quotations.user', 'user.profile')->search($search['q'])->paginate(10);

        return $quotationRequests;
    }

    
    public function getShippings()
    {
        $search['q'] = request('q');
        $country_id = request('country');

        $date_start = request('date_start') ? Carbon::parse(request('date_start')) : Carbon::now();
        $date_end = request('date_end') ? Carbon::parse(request('date_end')) : Carbon::now();

        $shippings = Shipping::where([
            ['date', '>=', $date_start],
            ['date', '<=', $date_end->endOfDay()]
        ])->where('country_id', $country_id)->with('quotation.user', 'user', 'shippingRequest')->search($search['q'])->paginate(10);




        return $shippings;

    }

    public function getShippingsRequests()
    {
        $search['q'] = request('q');
        $country_id = request('country');
        $date_start = request('date_start') ? Carbon::parse(request('date_start')) : Carbon::now();
        $date_end = request('date_end') ? Carbon::parse(request('date_end')) : Carbon::now();

        $shippingsRequests = ShippingRequest::where([
            ['date', '>=', $date_start],
            ['date', '<=', $date_end->endOfDay()]
        ])->where('country_id', $country_id)->with('quotation.user', 'user', 'shippings')->search($search['q'])->paginate(10);

        return $shippingsRequests;
    }

    public function getCreditRequests()
    {
        $search['q'] = request('q');
        $country_id = request('country');

        $date_start = request('date_start') ? Carbon::parse(request('date_start')) : Carbon::now();
        $date_end = request('date_end') ? Carbon::parse(request('date_end')) : Carbon::now();

        $creditRequests = CreditRequest::where([
            ['date', '>=', $date_start],
            ['date', '<=', $date_end->endOfDay()]
        ])->where('country_id', $country_id)->with('quotation.user', 'user', 'credits')->search($search['q'])->paginate(10);

        return $creditRequests;
    }

    public function getCredits()
    {
        $search['q'] = request('q');
        $country_id = request('country');

        $date_start = request('date_start') ? Carbon::parse(request('date_start')) : Carbon::now();
        $date_end = request('date_end') ? Carbon::parse(request('date_end')) : Carbon::now();

        $credits = Credit::where([
            ['date', '>=', $date_start],
            ['date', '<=', $date_end->endOfDay()]
        ])->where('country_id', $country_id)->with('quotation.user', 'user', 'creditRequest')->search($search['q'])->paginate(10);




        return $credits;

    }

    public function getPurchaseOrders()
    {
        $search['q'] = request('q');
        $country_id = request('country');

        $date_start = request('date_start') ? Carbon::parse(request('date_start')) : Carbon::now();
        $date_end = request('date_end') ? Carbon::parse(request('date_end')) : Carbon::now();

        $purchases = PurchaseOrder::where([
            ['created_at', '>=', $date_start],
            ['created_at', '<=', $date_end->endOfDay()]
        ])->where('country_id', $country_id)->with('quotation.user', 'user')->search($search['q'])->paginate(10);




        return $purchases;

    }


   

   
   
   
}
