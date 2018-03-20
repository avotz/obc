@component('mail::message')
# Dear Partner:


The Credit  <b>{{ $credit->transaction_id }}</b> was  {{ ($credit->status == 1) ? 'Approved' : 'Rejected' }}.

@component('mail::button', ['url' => env('APP_URL').'/credit/credits/'. $credit->id.'/edit'])
Go to the Credit
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


El Crédito  <b>{{ $credit->transaction_id }}</b> fue  {{ ($credit->status == 1) ? 'Aprobado' : 'Rechazado' }}.

@component('mail::button', ['url' => env('APP_URL').'/credit/credits/'. $credit->id.'/edit'])
Ir al crédito
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
