@component('mail::message')
# Dear Partner:

A person has requested a user account with your private code, enter your user profile and
approve or reject that request in a time no longer than 48 hours.


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado Socio:

Una persona ha solicitado una cuenta de usuario con tu código privado, entra a tu perfil de usuario y apruebe o rechace dicha solicitud en un tiempo no mayor a 48 horas. 


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
