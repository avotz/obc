@component('mail::message')
# Dear Partner:


A person has sent a purchase order to your quotation <b>{{ $purchase->quotation->transaction_id }}</b>. You can check it in the following link.

@component('mail::button', ['url' => env('APP_URL').'/purchases/'. $purchase->id.'/edit'])
Go to the Purchase Order
@endcomponent


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:


Una persona ha enviado una orden de compra a tu cotización (Quotation) <b>{{ $purchase->quotation->transaction_id }}</b>. Puede verificarlo en el siguiente enlace.

@component('mail::button', ['url' => env('APP_URL').'/purchases/'. $purchase->id.'/edit'])
Ir a la orden de compra
@endcomponent


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
