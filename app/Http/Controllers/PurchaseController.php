<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Commission;
use App\GlobalSetting;

class PurchaseController extends Controller
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
    public function index()
    {
    }

    /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quotation_id)
    {
        $quotation = Quotation::find($quotation_id);

        if ($quotation->purchase) {
            return redirect('/purchases/' . $quotation->purchase->id . '/edit');
        }

        $partner = $quotation->user->companies->first();

        $user = $quotation->user->load('profile');

        $shipping_company = 'N/A';
        $credit_company = 'N/A';
        
        $shipping_Granted = $quotation->shippings()->where('status', 1)->first();
        
        if($shipping_Granted)
            $shipping_company = $shipping_Granted->user->companies->first()->company_name;


        $credit_approved = $quotation->credits()->where('status', 1)->first();

        if ($credit_approved)
            $credit_company = $credit_approved->user->companies->first()->company_name;


        $company = auth()->user()->companies->first();

        $country = $company->countries->first();



        $currencies = [
            [
                'currency' => $country->currency,
                'symbol' => $country->currency_symbol
            ],
            [
                'currency' => 'USD',
                'symbol' => '$'
            ]
        ];

        $discount = GlobalSetting::first() ? GlobalSetting::first()->discount : 0;

        return view('purchases.create', compact('user', 'partner', 'quotation', 'shipping_company', 'credit_company','currencies', 'discount'));
    }

    public function store($quotation_id)
    {
        $quotation = Quotation::find($quotation_id);

        $this->validate(
            request(),

            [
            'amount' => 'required',
            'purchase_file' => 'mimes:jpeg,bmp,png,pdf',
        ]
        );

        $data = request()->all();

        $data['country_id'] = auth()->user()->companies->first()->country;

        $data['user_id'] = auth()->id();
        $data['geo_type'] = $quotation->geo_type;
        $data['discount'] = GlobalSetting::first() ? GlobalSetting::first()->discount : 0;

        $purchase = $quotation->purchase()->create($data);
        $purchase->generateTransactionId();

        $mimes = ['jpg', 'jpeg', 'bmp', 'png', 'pdf'];
        $fileUploaded = 'error';

        if (request()->file('purchase_file')) {
            $file = request()->file('purchase_file');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('purchases/' . $purchase->id . '/files', $purchase->id . '-' . $onlyName . '.' . $ext, 'public');

                $purchase->file = $purchase->id . '-' . $onlyName . '.' . $ext;
                $purchase->save();
            }
        }

        flash('Purchase order Saved', 'success');

        return redirect('requests/' . $quotation->request->id . '/quotations');
    }

    /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = PurchaseOrder::find($id);

        $quotation = $purchase->quotation;

        $partner = $quotation->user->companies->first();

        $user = $quotation->user->load('profile');

        $shipping_company = 'N/A';
        $credit_company = 'N/A';

        $shipping_Granted = $quotation->shippings()->where('status', 1)->first();

        if ($shipping_Granted)
            $shipping_company = $shipping_Granted->user->companies->first()->company_name;


        $credit_approved = $quotation->credits()->where('status', 1)->first();

        if ($credit_approved)
            $credit_company = $credit_approved->user->companies->first()->company_name;


        $company = (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin')) ? $purchase->user->companies->first() : auth()->user()->companies->first();

        $country = $company->countries->first();



        $currencies = [
            [
                'currency' => $country->currency,
                'symbol' => $country->currency_symbol
            ],
            [
                'currency' => 'USD',
                'symbol' => '$'
            ]
        ];
        $discount = GlobalSetting::first() ? GlobalSetting::first()->discount : 0;

        return view('purchases.edit', compact('user', 'partner', 'quotation', 'purchase', 'shipping_company', 'credit_company', 'currencies', 'discount'));
    }

    public function update($id)
    {
        $this->validate(
            request(),
            [
            'amount' => 'required',
            'purchase_file' => 'mimes:jpeg,bmp,png,pdf',
        ]
        );

        $purchase = PurchaseOrder::find($id);
        $purchase->fill(request()->all());
        $purchase->save();

        $mimes = ['jpg', 'jpeg', 'bmp', 'png', 'pdf'];
        $fileUploaded = 'error';

        if (request()->file('purchase_file')) {
            $file = request()->file('purchase_file');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('purchases/' . $purchase->id . '/files', $purchase->id . '-' . $onlyName . '.' . $ext, 'public');

                $purchase->file = $purchase->id . '-' . $onlyName . '.' . $ext;
                $purchase->save();
            }
        }

        flash('Purchase order updated', 'success');

        return redirect('requests/' . $purchase->quotation->request->id . '/quotations');
    }

    public function deleteFilePurchase($id)
    {
        $directory = 'purchases/' . $id;
        $purchase = PurchaseOrder::find($id);
        $purchase->file = '';
        $purchase->save();

        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);

        return 'ok';
    }

    public function update_status($id)
    {
        $purchase = \DB::table('purchase_orders')
            ->where('id', $id)
            ->update(['status' => request('status')]); //no asistio a la cita

        if(request('status') == 1 )
        {
            $purchase = PurchaseOrder::find($id);

            $quotation = $purchase->quotation;
            $gross_commission = GlobalSetting::first() ? GlobalSetting::first()->gross_commission : 0;
            $commission = Commission::create([
                'company_id' => $quotation->user->companies->first()->id,
                'purchase_order_id' => $purchase->id,
                'amount' => $purchase->amount,
                'discount' => $purchase->discount,
                'gross_commission' => $gross_commission,
                'total' => calculatePercentAmount($gross_commission, $purchase->amount) - calculatePercentAmount($purchase->discount, $purchase->amount),
                'currency' => $purchase->currency,
                'country_id' => auth()->user()->companies->first()->country

            ]);
        }

        return back();
    }

    /**
     * Eliminar consulta(cita)
     */
    public function destroy($id)
    {

        $purchase = PurchaseOrder::find($id);
        $requestId = $purchase->quotation->request->id;
        $purchase->delete();

        flash('Purchase Order Deleted', 'success');

        return redirect('requests/' . $requestId . '/quotations');

    }
}
