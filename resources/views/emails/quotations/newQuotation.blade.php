@component('mail::message')
# Dear Partner:


A person has sent a quotation to your request <b>{{ $quotation->request->transaction_id }}</b>. You can check it in the following link.

@component('mail::button', ['url' => env('APP_URL').'/requests/'. $quotation->request->id.'/quotations'])
Go to the request
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


Una persona ha enviado una cotizacion (Quotation) a tu solicitud <b>{{ $quotation->request->transaction_id }}</b>. Puede verificarlo en el siguiente enlace.

@component('mail::button', ['url' => env('APP_URL').'/requests/'. $quotation->request->id.'/quotations'])
Ir a solicitudes
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
