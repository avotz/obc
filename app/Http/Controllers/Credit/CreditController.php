<?php

namespace App\Http\Controllers\Credit;

use App\User;
use App\Repositories\UserRepository;
use App\Quotation;
use App\Credit;
use App\CreditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Mail\NewCredit;

class CreditController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('authByRole:credit');

        $this->userRepo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCredits()
    {
        $search['q'] = request('q');

        $partner = auth()->user()->companies->first();

        $credits = Credit::search($search['q'])->with('quotation.user', 'user', 'creditRequest')->paginate(10);

        return $credits;
    }

    /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($creditRequest_id)
    {
        $creditRequest = CreditRequest::find($creditRequest_id);

        $quotation = $creditRequest->quotation;

        if ($creditRequest->credits()->where('status', 1)->first()) {
            flash('This credit Request already has an approved Credit', 'warning');
            return back();
        }

        $partner = $quotation->user->companies->first();

        $user = $quotation->user->load('profile');

        $company_credit = auth()->user()->companies->first();

        $country = $company_credit->countries->first();

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

        $interests = $company_credit->interest;
        $interest = 0;
        $total = 0;

        if ($creditRequest->credit_time == 30) {
            $interest = $interests->interest_30;
        }
        if ($creditRequest->credit_time == 45) {
            $interest = $interests->interest_45;
        }
        if ($creditRequest->credit_time == 60) {
            $interest = $interests->interest_60;
        }

        $subtotal = ($interest / 100) * $creditRequest->amount;
        $total = $creditRequest->amount + $subtotal;

        return view('credit.credits.create', compact('user', 'partner', 'quotation', 'creditRequest', 'interest', 'interests', 'total', 'currencies'));
    }

    public function store($creditRequest_id)
    {
        $creditRequest = CreditRequest::find($creditRequest_id);

        $quotation = $creditRequest->quotation;

        $this->validate(
            request(),

            [
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'approval_date' => 'required|date',
            'payment_date' => 'required|date',
            'interest' => 'required|numeric',
            'total' => 'required|numeric',
            'credit_time' => 'required|numeric',
            'file' => 'mimes:jpeg,bmp,png,pdf',
        ]
        );

        $data = request()->all();

        $data['country_id'] = auth()->user()->companies->first()->country;
        $data['company_id'] = auth()->user()->companies->first()->id;

        $data['user_id'] = auth()->id();
        $data['credit_request_id'] = $creditRequest->id;

        $credit = $quotation->credits()->create($data);

        $credit->generateTransactionId();

        $partner = auth()->user()->companies->first();

        /* if($partner){

            $credit->suppliers()->sync([$partner->id]);
         }*/

        $mimes = ['jpg', 'jpeg', 'bmp', 'png', 'pdf'];
        $fileUploaded = 'error';

        if (request()->file('file')) {
            $file = request()->file('file');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('credits/' . $credit->id . '/files', $credit->id . '-' . $onlyName . '.' . $ext, 'public');

                $credit->file = $credit->id . '-' . $onlyName . '.' . $ext;
                $credit->save();
            }
        }

        try {
            \Mail::to([$creditRequest->user->email])->send(new NewCredit($credit));
        } catch (\Swift_TransportException $e) {  //Swift_RfcComplianceException
            \Log::error($e->getMessage());
        }

        flash('Credit Saved', 'success');

        return redirect('credit/credit-requests');
    }

    /**
     * create the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credit = Credit::find($id);

        $quotation = $credit->quotation;
        $creditRequest = $credit->creditRequest;

        $partner = $quotation->user->companies->first();

        $user = $quotation->user->load('profile');

        $company_credit = auth()->user()->companies->first();

        $country = $company_credit->countries->first();

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

        $interests = $company_credit->interest;
        $interest = 0;
        $total = 0;

        if ($creditRequest->credit_time == 30) {
            $interest = $interests->interest_30;
        }
        if ($creditRequest->credit_time == 45) {
            $interest = $interests->interest_45;
        }
        if ($creditRequest->credit_time == 60) {
            $interest = $interests->interest_60;
        }

        $subtotal = ($interest / 100) * $creditRequest->amount;
        $total = $creditRequest->amount + $subtotal;

        return view('credit.credits.edit', compact('user', 'partner', 'quotation', 'credit', 'creditRequest', 'interest', 'interests', 'total', 'currencies'));
    }

    public function update($id)
    {
        $this->validate(
            request(),
            [
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'approval_date' => 'required|date',
            'payment_date' => 'required|date',
            'interest' => 'required|numeric',
            'total' => 'required|numeric',
            'credit_time' => 'required|numeric',
            'file' => 'mimes:jpeg,bmp,png,pdf',
        ]
        );

        $credit = Credit::find($id);
        $credit->fill(request()->all());
        $credit->save();

        $mimes = ['jpg', 'jpeg', 'bmp', 'png', 'pdf'];
        $fileUploaded = 'error';

        if (request()->file('file')) {
            $file = request()->file('file');

            $name = $file->getClientOriginalName();
            $ext = $file->guessClientExtension();
            $onlyName = str_slug(pathinfo($name)['filename'], '-');

            if (in_array($ext, $mimes)) {
                $fileUploaded = $file->storeAs('credits/' . $credit->id . '/files', $credit->id . '-' . $onlyName . '.' . $ext, 'public');

                $credit->file = $credit->id . '-' . $onlyName . '.' . $ext;
                $credit->save();
            }
        }

        flash('Credit  updated', 'success');

        return redirect('credit/credit-requests');
    }

    public function update_interest($company_id)
    {
        $interest = \DB::table('interests')
            ->where('company_id', $company_id)
            ->update(['interest_30' => request('interest_30'),
                      'interest_45' => request('interest_45'),
                      'interest_60' => request('interest_60')
                    ]); //no asistio a la cita

        return back();
    }

    public function deleteFilecredit($id)
    {
        $directory = 'credits/' . $id . '/files';
        $credit = Credit::find($id);
        $credit->file = '';
        $credit->save();

        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);

        return 'ok';
    }

    public function update_status($id)
    {
        $credit = \DB::table('credits')
            ->where('id', $id)
            ->update(['status' => request('status')]); //no asistio a la cita

        return back();
    }

    /**
     * suppliers list for select.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credit = Credit::find($id);
        $directory = 'credits/' . $id . '/files';

        $credit->delete();

        //Storage::disk('public')->delete("avatars/". $id, "avatar.jpg");
        Storage::disk('public')->deleteDirectory($directory);

        return back();
    }
}
