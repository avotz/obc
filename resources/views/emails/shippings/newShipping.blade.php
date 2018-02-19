@component('mail::message')
# Dear Partner (Estimado Socio):


A person has sent a Shipping to your request <b>{{ $shipping->shippingRequest->transaction_id }}</b>. You can check it in the following link.

Una persona ha enviado un envío (Shipping) a su solicitud <b>{{ $shipping->shippingRequest->transaction_id }}</b>. Puede verificarlo en el siguiente enlace.

@component('mail::button', ['url' => env('APP_URL').'/shippings/'. $shipping->id.'/edit'])
Go to the Shipping (Ir a Envios)
@endcomponent


Sincerely (Atentamente),<br>
IT Support (Departamento de Soporte Técnico).{{ config('app.name') }}
@endcomponent
