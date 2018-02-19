@component('mail::message')
# Dear Partner (Estimado Socio):


The Credit  <b>{{ $credit->transaction_id }}</b> was  {{ ($credit->status == 1) ? 'Approved' : 'Rejected' }}.

El Crédito  <b>{{ $credit->transaction_id }}</b> fue  {{ ($credit->status == 1) ? 'Aprobado' : 'Rechazado' }}.

@component('mail::button', ['url' => env('APP_URL').'/credit/credits/'. $credit->id.'/edit'])
Go to the Credit (Ir al crédito)
@endcomponent


Sincerely (Atentamente),<br>
IT Support (Departamento de Soporte Técnico).{{ config('app.name') }}
@endcomponent
