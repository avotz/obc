@component('mail::message')
# Dear Partner:


A person has sent a Shipping to your request <b>{{ $shipping->shippingRequest->transaction_id }}</b>. You can check it in the following link.

@component('mail::button', ['url' => env('APP_URL').'/shippings/'. $shipping->id.'/edit'])
Go to the Shipping
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}
@endcomponent
