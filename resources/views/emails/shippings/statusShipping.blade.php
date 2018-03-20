@component('mail::message')
# Dear Partner:


The Shipping  <b>{{ $shipping->transaction_id }}</b> was  {{ ($shipping->status == 1) ? 'Approved' : 'Rejected' }}.

@component('mail::button', ['url' => env('APP_URL').'/shipping/shippings/'. $shipping->id.'/edit'])
Go to the Shipping
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


El Envio  <b>{{ $shipping->transaction_id }}</b> fue  {{ ($shipping->status == 1) ? 'Aprobado' : 'Rechazado' }}.

@component('mail::button', ['url' => env('APP_URL').'/shipping/shippings/'. $shipping->id.'/edit'])
Ir a Envios
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
