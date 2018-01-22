@component('mail::message')
# Dear Partner:


A person has sent a quotation to your request <b>{{ $quotation->request->transaction_id }}</b>. You can check it in the following link.

@component('mail::button', ['url' => env('APP_URL').'/requests/'. $quotation->request->id.'/quotations'])
Go to the request
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}
@endcomponent
