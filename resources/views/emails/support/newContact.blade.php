@component('mail::message')
# You have a question about {{ $dataMessage['subject'] }} by {{ $dataMessage['firstname'] }} ({{ $dataMessage['email'] }})

{{ $dataMessage['msg'] }}


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Tienes una consulta sobre {{ $dataMessage['subject'] }} por {{ $dataMessage['firstname'] }} ({{ $dataMessage['email'] }})

{{ $dataMessage['msg'] }}


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
