@component('mail::message')
# New Partner Account

A person has requested a partner account.  You can check it to approved in the following link.

@component('mail::button', ['url' => env('APP_URL').'/admin/users'])
Go to the users
@endcomponent

Sincerely,<br>
IT Support.{{ config('app.name') }}


# Nueva cuenta de asociado

Una persona ha solicitado una cuenta de asociado (partner). Puede verificarlo para su aprobación en el siguiente enlace.. 

@component('mail::button', ['url' => env('APP_URL').'/admin/users'])
Ir a usuarios
@endcomponent

Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
