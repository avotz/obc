@component('mail::message')
# Dear Partner (Estimado Socio):


The Purchase Order  <b>{{ $purchase->transaction_id }}</b> was  {{ ($purchase->status == 1) ? 'Approved' : 'Rejected' }}.

La orden de compra <b>{{ $purchase->transaction_id }}</b> fue  {{ ($purchase->status == 1) ? 'Aprobada' : 'Rechazada' }}.

@component('mail::button', ['url' => env('APP_URL').'/purchases/'. $purchase->id.'/edit'])
Go to the Purchase Order (Ir a la orden de compra)
@endcomponent


Sincerely (Atentamente),<br>
IT Support (Departamento de Soporte Técnico).{{ config('app.name') }}
@endcomponent
