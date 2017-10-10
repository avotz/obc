@component('mail::message')
# Tienes una consulta sobre {{ $dataMessage['modal-questions-subject'] }} por {{ $dataMessage['questionUser']->public_code }} ({{ $dataMessage['questionUser']->email }})

{{ $dataMessage['modal-questions-msg'] }}


Sincerely,<br>
IT Support.{{ config('app.name') }}
@endcomponent
