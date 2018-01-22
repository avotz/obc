<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UserRepository;
use App\QuotationRequest;
use App\Quotation;
use App\CreditDays;
use App\Rules\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\GlobalSetting;
use App\Mail\NewQuotation;

class QuotationController extends Controller
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
    public function index($quotation_request_id)
    {
        $quotationRequest = QuotationRequest::find($quotation_request_id);
        if (!$quotationRequest || !$quotationRequest->createdBy(auth()->user())) {
            return redirect('/public/requests');
        }

        $quotations = $quotationRequest->quotations();
        $quotations = $quotations->paginate(10);

        return view('quotations.index', compact('quotations'));
    }

    /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quotation_request_id)
    {
        $quotationRequest = QuotationRequest::find($quotation_request_id);
        $partner = $quotationRequest->user->companies->first();
        $user = $quotationRequest->user->load('profile');

        // $creditDays = CreditDays::all();
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

        return view('quotations.create', compact('user', 'partner', 'quotationRequest', 'currencies', 'discount'));
    }

    public function store($quotation_request_id)
    {
        $quotationRequest = QuotationRequest::find($quotation_request_id);

        $this->validate(
            request(),

            [
            'delivery_time' => 'required|string|max:255',
            'way_of_delivery' => 'required|string|max:255',
            'way_to_pay' => 'required|string|max:255',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            'product_photo' => 'mimes:jpeg,bmp,png,pdf',
        ]
        );

        $data = request()->all();

        $data['country_id'] = auth()->user()->companies->first()->country;
        $data['company_id'] = auth()->user()->companies->first()->id;

        $data['user_id'] = auth()->id();
        $data['geo_type'] = $quotationRequest->geo_type;
        $data['discount'] = GlobalSetting::first() ? GlobalSetting::first()->discount : 0;

        $quotation = $quotationRequest->quotations()->create($data);
        $quotation->generateTransactionId();

        $mimes = ['jpg', 'jpeg', 'bmp', 'png', 'pdf'];
        $fileUploaded = 'error';

        if (request()->file('product_photo')) {
            $file = request()->file('product_photo');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('quotations/' . $quotation->id . '/product', $quotation->id . '-' . $onlyName . '.' . $ext, 'public');

                $quotation->product_photo = $quotation->id . '-' . $onlyName . '.' . $ext;
                $quotation->save();
            }
        }

        if (request()->file('file')) {
            $file = request()->file('file');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('quotations/' . $quotation->id . '/files', $quotation->id . '-' . $onlyName . '.' . $ext, 'public');

                $quotation->file = $quotation->id . '-' . $onlyName . '.' . $ext;
                $quotation->save();
            }
        }

        try {
            \Mail::to([$quotationRequest->user->email])->send(new NewQuotation($quotation));
        } catch (\Swift_TransportException $e) {  //Swift_RfcComplianceException
            \Log::error($e->getMessage());
        }

        flash('Quotation Saved', 'success');

        return redirect('/public/requests');
    }

    /**
     * edit the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotation = Quotation::find($id);

        if (!$quotation->createdBy(auth()->user()) && !auth()->user()->hasRole('admin') && !auth()->user()->hasRole('superadmin')) {
            return redirect('/public/requests');
        }

        $quotationRequest = $quotation->request;

        $partner = $quotationRequest->user->companies->first();

        $user = $quotationRequest->user->load('profile');

        //$creditDays = CreditDays::all();
        $discount = GlobalSetting::first() ? GlobalSetting::first()->discount : 0;

        return view('quotations.edit', compact('user', 'partner', 'quotation', 'quotationRequest', 'discount'));
    }

    /**
     * update the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(
            request(),
            [
            'delivery_time' => 'required|string|max:255',
            'way_of_delivery' => 'required|string|max:255',
            'way_to_pay' => 'required|string|max:255',
            'file' => 'mimes:jpeg,bmp,png,pdf',
            'product_photo' => 'mimes:jpeg,bmp,png',
        ]
        );

        $quotation = Quotation::find($id);
        $quotation->fill(request()->all());
        $quotation->save();

        $mimes = ['jpg', 'jpeg', 'bmp', 'png'];
        $fileUploaded = 'error';

        if (request()->file('product_photo')) {
            $file = request()->file('product_photo');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('quotations/' . $quotation->id . '/product', $quotation->id . '-' . $onlyName . '.' . $ext, 'public');

                $quotation->product_photo = $quotation->id . '-' . $onlyName . '.' . $ext;
                $quotation->save();
            }
        }

        $mimes = ['jpg', 'jpeg', 'bmp', 'png', 'pdf'];

        if (request()->file('file')) {
            $file = request()->file('file');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('quotations/' . $quotation->id . '/files', $quotation->id . '-' . $onlyName . '.' . $ext, 'public');

                $quotation->file = $quotation->id . '-' . $onlyName . '.' . $ext;
                $quotation->save();
            }
        }

        flash('Quotation updated', 'success');

        return redirect('/quotations/' . $quotation->id . '/edit');
    }

    public function deleteProductPhoto($id)
    {
        $directory = 'quotations/' . $id . '/product';
        $quotation = Quotation::find($id);
        $quotation->product_photo = '';
        $quotation->save();

        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);

        return 'ok';
    }

    public function deleteFile($id)
    {
        $directory = 'quotations/' . $id . '/files';
        $quotation = Quotation::find($id);
        $quotation->product_photo = '';
        $quotation->save();

        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);

        return 'ok';
    }
}
