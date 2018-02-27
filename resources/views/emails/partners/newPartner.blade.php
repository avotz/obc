@component('mail::message')
# New Partner Account (Nueva cuenta de asociado)

A person has requested a partner account.  You can check it to approved in the following link.

Una persona ha solicitado una cuenta de asociado (partner). Puede verificarlo para su aprobación en el siguiente enlace.. 

@component('mail::button', ['url' => env('APP_URL').'/admin/users'])
Go to the users (Ir a usuarios)
@endcomponent

Sincerely (Atentamente),<br>
IT Support (Departamento de Soporte Técnico).{{ config('app.name') }}
@endcomponent
