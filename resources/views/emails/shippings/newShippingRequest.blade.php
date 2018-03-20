@component('mail::message')
# Dear Partner:


A person has sent a Shipping Request to your Company <b>{{ $shippingRequest->transaction_id }}</b>. You can check it in the following link.

@component('mail::button', ['url' => env('APP_URL').'/shipping/shipping-requests/'. $shippingRequest->id.'/edit'])
Go to the Shipping request
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


Una persona ha enviado una solicitud de envío (Shipping Request) a su compañia <b>{{ $shipping->shippingRequest->transaction_id }}</b>. Puede verificarlo en el siguiente enlace.

@component('mail::button', ['url' => env('APP_URL').'/shipping/shipping-requests/'. $shippingRequest->id.'/edit'])
Ir a Solicitudes de envio
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
