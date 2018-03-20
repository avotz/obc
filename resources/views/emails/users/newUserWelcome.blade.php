@component('mail::message')
# New User Account

Your application is in the process of approval by the partner who supplied the user
account creation code. Once the partner approves your request, your account will be
registered in the OBC system, and you can use the online platform 24/7.


Sincerely,<br>
IT Support.{{ config('app.name') }}


# Nueva cuenta de usuario

Su solicitud está en proceso de aprobación por parte del asociado que suministró el código de creación de cuenta de usuario, una vez que el asociado apruebe tu solicitud, tu cuenta estará dada de alta en el sistema de OBC, y podrá ser uso de la plataforma online 24/7.


Atentamente,<br>
Departamento de Soporte Técnico.{{ config('app.name') }}
@endcomponent