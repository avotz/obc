@component('mail::message')
# Tienes una consulta sobre {{ $dataMessage['modal_questions_subject'] }} por {{ $dataMessage['questionUser']->public_code }} ({{ $dataMessage['questionUser']->email }})

{{ $dataMessage['modal_questions_msg'] }}


Sincerely,<br>
IT Support.{{ config('app.name') }}
@endcomponent
