@component('mail::message')
# Dear Partner (Estimado Socio):


The Shipping  <b>{{ $shipping->transaction_id }}</b> was  {{ ($shipping->status == 1) ? 'Approved' : 'Rejected' }}.

El Envio  <b>{{ $shipping->transaction_id }}</b> fue  {{ ($shipping->status == 1) ? 'Aprobado' : 'Rechazado' }}.

@component('mail::button', ['url' => env('APP_URL').'/shipping/shippings/'. $shipping->id.'/edit'])
Go to the Shipping (Ir a Envios)
@endcomponent


Sincerely (Atentamente),<br>
IT Support (Departamento de Soporte Técnico).{{ config('app.name') }}
@endcomponent
