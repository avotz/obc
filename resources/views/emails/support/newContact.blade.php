@component('mail::message')
# Tienes una consulta sobre {{ $dataMessage['subject'] }} por {{ $dataMessage['firstname'] }} ({{ $dataMessage['email'] }})

{{ $dataMessage['msg'] }}


Sincerely,<br>
IT Support.{{ config('app.name') }}
@endcomponent
