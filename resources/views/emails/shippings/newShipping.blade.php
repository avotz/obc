@component('mail::message')
# Dear Partner:


A person has sent a Shipping to your request <b>{{ $shipping->shippingRequest->transaction_id }}</b>. You can check it in the following link.

@component('mail::button', ['url' => env('APP_URL').'/shippings/'. $shipping->id.'/edit'])
Go to the Shipping
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


Una persona ha enviado un envío (Shipping) a su solicitud <b>{{ $shipping->shippingRequest->transaction_id }}</b>. Puede verificarlo en el siguiente enlace.

@component('mail::button', ['url' => env('APP_URL').'/shippings/'. $shipping->id.'/edit'])
Ir a Envios
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
