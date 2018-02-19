@component('mail::message')
# You have a question about {{ $dataMessage['subject'] }} by {{ $dataMessage['firstname'] }} ({{ $dataMessage['email'] }})
Tienes una consulta sobre {{ $dataMessage['subject'] }} por {{ $dataMessage['firstname'] }} ({{ $dataMessage['email'] }})

{{ $dataMessage['msg'] }}


Sincerely (Atentamente),<br>
IT Support (Departamento de Soporte Técnico).{{ config('app.name') }}
@endcomponent
