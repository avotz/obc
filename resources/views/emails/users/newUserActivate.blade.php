@component('mail::message')
# Dear User:

Your request to open a account has been approved. You can use the online platform 24/7.

Sincerely,<br>
IT Support.{{ config('app.name') }}


# Estimado usuario:

Su solicitud para abrir una cuenta ha sido aprobada. Puede usar la plataforma en línea 24/7.

Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent
