@component('mail::message')
# You have a question about {{ $dataMessage['modal_questions_subject'] }} by {{ $dataMessage['questionUser']->public_code }} ({{ $dataMessage['questionUser']->email }})

{{ $dataMessage['modal_questions_msg'] }}


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Tienes una consulta sobre {{ $dataMessage['modal_questions_subject'] }} por {{ $dataMessage['questionUser']->public_code }} ({{ $dataMessage['questionUser']->email }})

{{ $dataMessage['modal_questions_msg'] }}


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
