@component('mail::message')
# Hello {{ $name }}

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Sincerely,<br>
{{ config('app.name') }}

@component('mail::subcopy', ['url' => $url])
If you’re having trouble clicking the "Reset " button, copy and paste the URL below
into your web browser: [{{ $url}}]({{ $url}})
@endcomponent



# Hola {{ $name }}

Usted está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.

@component('mail::button', ['url' => $url])
Cambiar contraseña
@endcomponent

Atentamente,<br>
{{ config('app.name') }}

@component('mail::subcopy', ['url' => $url])
Si tiene problemas para hacer clic en el botón "Cambiar contraseña", copie y pegue la siguiente URL
en su navegador web [{{ $url}}]({{ $url}})
@endcomponent



@endcomponent
