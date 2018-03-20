@component('mail::message')
# Dear Partner:


A person has sent a Credit to your request <b>{{ $credit->creditRequest->transaction_id }}</b>. You can check it in the following link.

@component('mail::button', ['url' => env('APP_URL').'/credits/'. $credit->id.'/edit'])
Go to the Credit
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


Una persona ha enviado un crédito a tu solicitud (Credit Request) <b>{{ $credit->creditRequest->transaction_id }}</b>. Puede verificarlo en el siguiente enlace.

@component('mail::button', ['url' => env('APP_URL').'/credits/'. $credit->id.'/edit'])
Ir al credito
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
