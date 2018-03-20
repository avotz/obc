@component('mail::message')
# Dear Partner:


The Purchase Order  <b>{{ $purchase->transaction_id }}</b> was  {{ ($purchase->status == 1) ? 'Approved' : 'Rejected' }}.

@component('mail::button', ['url' => env('APP_URL').'/purchases/'. $purchase->id.'/edit'])
Go to the Purchase Order
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


La orden de compra <b>{{ $purchase->transaction_id }}</b> fue  {{ ($purchase->status == 1) ? 'Aprobada' : 'Rechazada' }}.

@component('mail::button', ['url' => env('APP_URL').'/purchases/'. $purchase->id.'/edit'])
Ir a la orden de compra
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
