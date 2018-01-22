@component('mail::message')
# Dear Partner:


The Purchase Order  <b>{{ $purchase->transaction_id }}</b> was  {{ ($purchase->status == 1) ? 'Approved' : 'Rejected' }}.

@component('mail::button', ['url' => env('APP_URL').'/purchases/'. $purchase->id.'/edit'])
Go to the Purchase Order
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}
@endcomponent
